import DivTable from "./DivTable";

export default function DiveParameters({params})
{
    var dic = [
        {"key": "Respiration moyenne", "value": (params?.avgBreath ?? "") + " (L/min)"},
        {"key": "Vitesse de descente", "value": (params?.speedFalling ?? "") + " (m/min)"},
        {"key": "Vitesse de remontée avant palier", "value": (params?.speedRisingBeforeBearing ?? "") + " (m/min)"},
        {"key": "Vitesse de remontée entre paliers", "value": (params?.speedRisingBetweenBearing ?? "") + " (m/min)"}
    ];
    return (
        <div>
            <DivTable params={dic}/>
        </div>
    )
}