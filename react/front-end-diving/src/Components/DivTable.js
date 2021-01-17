/**
 * Transforms a dictionnary into a table like view (model: [{"key": "", "value": ""}])
 * @param {map} param0 map/dictionnary to transform into a table view
 */
export default function DivTable({params})
{
    return (
        <div>
            {params.map((value, index) => 
            {
                return (
                    <div className="row" id={index}>
                        <div className="col-25">
                            <label>{value?.key}</label>
                        </div>
                        <div className="col-75">
                            <label>{value?.value}</label>
                        </div>
                    </div>
                )
            })}
        </div>
    )
}