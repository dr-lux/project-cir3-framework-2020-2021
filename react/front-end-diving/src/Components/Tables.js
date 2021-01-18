import { useEffect, useState } from "react";
import Config from "../Tools/Config";
import Tool from "../Tools/Tool";
import DivTable from "./DivTable";

export default function Tables()
{
    const [tables, setTables] = useState([]);
    useEffect(() => 
    {
        Tool.fetchAndJson(Config.getApiUrl("temps"))
            .then(res => setTables(res));
    });
    return (
        <div className="content">
            <div className="container">
                {tables?.map((item, index) => 
                {
                    <li key={index}>
                        {JSON.stringify(item)}
                    </li>
                })}
            </div>
        </div>
    );
}