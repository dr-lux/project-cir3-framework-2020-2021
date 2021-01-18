import React from "react";
import DivTable from "./DivTable";
// eslint-disable-next-line
import Temps from '../Dto/Temps';

/**
 * React component.
 * @param {[Temps, object, number]} param0 
 */
export default function Dive({dive, defaultParameters, airVolume})
{   
    let airConsumed = dive.getAirConsumedVolume(
        defaultParameters.avgBreath,
        airVolume,
        defaultParameters.speedFalling,
        defaultParameters.speedRisingBeforeBearing,
        defaultParameters.speedRisingBetweenBearing
    );
    var dic = [
        {"key": "Palier 3 :", "value": dive.palier3 ? dive.palier3 + " minutes" : "pas de palier à 3 m"},
        {"key": "Palier 6 :", "value": dive.palier6 ? dive.palier6 + " minutes" : "pas de palier à 6 m"},
        {"key": "Palier 9 :", "value": dive.palier9 ? dive.palier9 + " minutes" : "pas de palier à 9 m"},
        {"key": "Palier 12 :", "value": dive.palier12 ? dive.palier12 + " minutes" : "pas de palier à 12 m"},
        {"key": "Palier 15 :", "value": dive.palier15 ? dive.palier15 + " minutes" : "pas de palier à 15 m"},
        {"key": "Temps total de plongée (DTP) :", "value": dive.getDTP(defaultParameters.speedFalling) + " minutes"},
        {"key": "Temps total de remontée (DTR) :", "value": dive.getDTR() + " minutes"},
        {"key": "Volume d'air consommé :", "value": airConsumed ? airConsumed + " litres" : ""}
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