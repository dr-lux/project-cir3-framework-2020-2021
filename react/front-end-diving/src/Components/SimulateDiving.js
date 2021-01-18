import React, { useEffect, useState } from "react";
import Dive from "./Dive";
import TwoStateForm from "./TwoStateForm";
import DiveParameters from './DiveParameters';
import Temps from "../Dto/Temps";
import Config from "../Tools/Config";
import Tool from '../Tools/Tool';

export default function SimulateDiving()
{   
    // data
    const [defaultParams, setDefaultParams] = useState(undefined);
    useEffect(() => 
    {
        // call to fetch should be cleaned up when unmounting component
        fetch(Config.getUrl("defaultParam"), Tool.getRequestOptions())
            .then(res => 
            {
                res.json()
                    .then(value => setDefaultParams(value?.[0] ? value?.[0] : {"id":1,"avgBreath":20,"speedFalling":20,"speedRisingBeforeBearing":10,"speedRisingBetweenBearing":6}));
            })
            .catch(err => 
            {
                console.error(JSON.stringify(err));
            });
    });

    // states
    const [formSubmitted, setFormSubmitted] = useState(false);
    const [formData, setFormData] = useState(undefined);
    const [bottleContent, setBottleContent] = useState(undefined);
    const [errorMessage, setErrorMessage] = useState("");
    const [formErrorState, setFormErrorState] = useState(false);

    // events handlers
    async function onFormSubmit(e) {
        e.preventDefault();

        let form = new FormData(document.getElementById("divingSimulationForm"));
        
        let bottlePressure = form.get("bottlePressure");
        let bottleVolume = form.get("volume");
        let depth = form.get("depth");
        let time = form.get("depthDuration");

        if (!bottlePressure || !bottleVolume || !depth || !time)
        {
            return false;
        }

        if (!Number.isNaN(Number.parseInt(bottlePressure)) && !Number.isNaN(Number.parseInt(bottleVolume))) {
            setBottleContent(Number.parseInt(bottlePressure) * Number.parseInt(bottleVolume));
        }

        let formState = true;
        try 
        {
            let depthApi = await Tool.fetchAndJson(Tool.buildApiUrl(
                {"depth": depth},
                Config.getApiUrl("depth")), true);

            let dives = await Tool.fetchAndJson(Tool.buildApiUrl(
                {"depth": depth, "time": time}, 
                Config.getApiUrl("search")
            ));

            let tempsArray = [];

            dives.forEach(item => 
            {
                let temps = new Temps(item);
                temps.depth = depthApi?.profondeur;
                tempsArray.push(temps);
            });

            setFormData(tempsArray);
    
            setFormSubmitted(true);
        }
        catch (e)
        {
            console.error(e.toString());
            formState = false;
        }

        return formState;
    }

    if (!formSubmitted)
    {
        return (
            <div className="content">
                <div>
                    <div className="error-message" hidden={formErrorState ? "hidden" : ""}>
                        <p><b>{errorMessage}</b></p>
                    </div>
                    <h1>Simulation de plongée</h1>
                    <div className="container">
                        <TwoStateForm 
                            inline={formSubmitted}
                            onFormSubmit={onFormSubmit} 
                            formId="divingSimulationForm"/>
                    </div>
                </div>
                <div>
                    <h1>Paramètres de la plongée</h1>
                    <div className="container">
                        <DiveParameters params={defaultParams}/>
                    </div>
                </div>
            </div>
        );
    }
    else 
    {
        return (
        <div className="content">
            <button onClick={() => setFormSubmitted(false)}>◀</button>
            <ul>
                {
                    formData.map((value, index) => 
                    {
                        return (
                            <li key={index}>
                                <Dive 
                                    dive={value} 
                                    defaultParameters={defaultParams}
                                    airVolume = {bottleContent}
                                />
                            </li>
                        )
                    })
                }
            </ul>
        </div>
        );
    }
}