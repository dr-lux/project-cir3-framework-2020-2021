import React from "react";
import DivTable from "./DivTable";
// eslint-disable-next-line
import Temps from '../Dto/Temps';

/**
 * React component.
 * @param {[Temps, object, number]} param0 
 */
export default function Dive({dive, defaultParameters, bottleParams})
{   
    let res = dive.getAirConsumedVolume(
        defaultParameters.avgBreath,
        bottleParams[0] * bottleParams[1],
        defaultParameters.speedFalling,
        defaultParameters.speedRisingBeforeBearing,
        defaultParameters.speedRisingBetweenBearing
    );
    let airConsumed = res[0];

    let remPressure = ((bottleParams[0] * bottleParams[1]) - airConsumed) / bottleParams[1];
    let remPressureUp = ((bottleParams[0] * bottleParams[1]) - res[1]) / bottleParams[1];
    console.log(res)

    var dic = [
        {"key": "Volume d'air disponible total :", "value": (bottleParams[0] * bottleParams[1]) + " litres"},
        {"key": "Volume d'air disponible a la remontée :", "value": ((bottleParams[0] * bottleParams[1]) - res[1]) + " litres"},
        {"key": "Pression disponible a la remontée :", "value": remPressureUp < 0 ? 0 + " bar" : remPressureUp + " bars"},
        {"key": "Volume d'air consommé :", "value": airConsumed ? airConsumed + " litres" : ""},
        {"key": "Pression restante :", "value": remPressure < 0 ? 0 + " bar" : remPressure + " bars"},
        {"key": "Palier 3 :", "value": dive.palier3 ? dive.palier3 + " minutes" : "pas de palier à 3 m"},
        {"key": "Palier 6 :", "value": dive.palier6 ? dive.palier6 + " minutes" : "pas de palier à 6 m"},
        {"key": "Palier 9 :", "value": dive.palier9 ? dive.palier9 + " minutes" : "pas de palier à 9 m"},
        {"key": "Palier 12 :", "value": dive.palier12 ? dive.palier12 + " minutes" : "pas de palier à 12 m"},
        {"key": "Palier 15 :", "value": dive.palier15 ? dive.palier15 + " minutes" : "pas de palier à 15 m"},
        {"key": "Temps total de plongée (DTP) :", "value": dive.getDTP(defaultParameters.speedFalling) + " minutes"},
        {"key": "Temps total de remontée (DTR) :", "value": dive.getDTR() + " minutes"}
    ]
    return (
        <div>
            <h2>Plongée a {dive.depth} mètres</h2>
            <div className="container">
                <DivTable params={dic}/>
            </div>
        </div>
    );
}