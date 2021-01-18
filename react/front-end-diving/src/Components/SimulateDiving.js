import React, { useEffect, useState } from "react";
import Dive from "./Dive";
import TwoStateForm from "./TwoStateForm";
import DiveParameters from './DiveParameters';
import Temps from "../Dto/Temps";
import Config from "../Tools/Config";
import Tool from '../Tools/Tool';

export default function SimulateDiving()
{   
    // states
    const [formSubmitted, setFormSubmitted] = useState(false);
    const [formData, setFormData] = useState(undefined);
    const [bottleContent, setBottleContent] = useState(undefined);
    const [errorMessage, setErrorMessage] = useState("");
    const [formErrorState, setFormErrorState] = useState(false);
    const [apiError, setApiError] = useState(false);

    // data
    const [defaultParams, setDefaultParams] = useState(undefined);
    useEffect(() => 
    {
        // call to fetch should be cleaned up when unmounting component
        fetch(Config.getApiUrl("defaultParam"), Tool.getRequestOptions())
            .then(res => 
            {
                if (!res.ok)
                {
                    setErrorMessage(res.status);
                }
                res.json()
                    .then(value => setDefaultParams(value?.[0] ? value?.[0] : {"id":1,"avgBreath":20,"speedFalling":20,"speedRisingBeforeBearing":10,"speedRisingBetweenBearing":6}))
                    .catch(error => console.error(error));
            })
            .catch(err => 
            {
                console.error(err.toString());
                setErrorMessage("A problem occurred when contacting data base server. Wait for a bit while we try to resolve this problem on our side...");
                setApiError(true);
            });
    });

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
            setErrorMessage("Merci de completer tous les champs");
            setFormErrorState(true);
            return false;
        }

        if (!Number.isNaN(Number.parseInt(bottlePressure)) && !Number.isNaN(Number.parseInt(bottleVolume)))
        {
            setBottleContent(Number.parseInt(bottlePressure) * Number.parseInt(bottleVolume));
        }
        else
        {
            setFormErrorState(true);
            setErrorMessage("Merci de remplir les champs pression de la bouteille et volume de la bouteille avec des valeurs numeriques");
            return false;
        }
        console.error(depth);
        if (Number.isNaN(Number.parseInt(depth)) || Number.isNaN(Number.parseInt(depth)))
        {
            setErrorMessage("Merci de remplir les champs profondeur maxi et duree de la plongee avec des valeurs numeriques");
            setFormErrorState(true);
            return false;
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
            setFormErrorState(true);
            setErrorMessage("Valeurs rentrées invalides, merci de choisir une profondeur plus basse ou/et un temps plus court");
            formState = false;

        }

        return formState;
    }

    if (apiError)
    {
        return (
            <div className="content">
                <div>
                    <div className="error-message" hidden={!apiError ? "hidden" : ""}>
                        <p><b>{errorMessage} 🤔</b></p>
                    </div>
                </div>
            </div>
        );
    }
    if (!formSubmitted)
    {
        return (
            <div className="content">
                <div>
                    <h1>Simulation de plongée</h1>
                    <div className={formErrorState ? "container-error" : "container"}>
                        <TwoStateForm 
                            onFormSubmit={onFormSubmit} 
                            formId="divingSimulationForm"
                            errorState={formErrorState}
                            errorMessage={errorMessage}/>
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