import { useEffect, useState } from "react";
import Config from "../Tools/Config";
import Tool from "../Tools/Tool";
import DivTable from "./DivTable";

export default function Tables()
{
    const [tables, setTables] = useState(undefined);
    const [depths, setDepths] = useState(undefined);
    useEffect(() => 
    {
        Tool.fetchAndJson(Config.getApiUrl("temps"))
            .then(res => setTables(res));
        Tool.fetchAndJson(Config.getApiUrl("profondeur"))
            .then(res => setDepths(res));
    });

    return (
        <div>
            <div className="content">
                <h1>Profondeurs disponibles</h1>
                <ul>
                    {depths?.map((item, index) => 
                    {
                        return (
                            <li key={index}>
                                <div className="container">
                                    <DivTable params={
                                        [
                                            {"key": "Profondeur de plongée :", "value": item?.profondeur + " mètre"}
                                        ]
                                    }/>
                                </div>
                            </li>
                        )
                    })}
                </ul>
            </div>
            <div className="content">
            <h1>Tables de calculs</h1>
                <ul>
                    {tables?.map((item, index) => 
                    {
                        return (
                            <li key={index}>
                                <div className="container">
                                    <DivTable params={
                                        [
                                            {"key": "temps de plongee", "value": item?.temps + " minutes"},
                                            {"key": "Palier 3 :", "value": item.palier3 ? item.palier3 + " minutes" : "pas de palier à 3 m"},
                                            {"key": "Palier 6 :", "value": item.palier6 ? item.palier6 + " minutes" : "pas de palier à 6 m"},
                                            {"key": "Palier 9 :", "value": item.palier9 ? item.palier9 + " minutes" : "pas de palier à 9 m"},
                                            {"key": "Palier 12 :", "value": item.palier12 ? item.palier12 + " minutes" : "pas de palier à 12 m"},
                                            {"key": "Palier 15 :", "value": item.palier15 ? item.palier15 + " minutes" : "pas de palier à 15 m"}
                                        ]
                                    }/>
                                </div>
                            </li>
                            
                        )
                    })}
                </ul>
            </div>
        </div>
    );
}