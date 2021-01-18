import React from 'react';

export default function TwoStateForm({onFormSubmit, formId, errorState = false, errorMessage = ""})
{
    return (
        <form action="/" onSubmit={onFormSubmit} id={formId}>
                <div className="row">
                    <div className="col-25">
                        <label htmlFor="bottlePressure">Pression bouteille</label>
                    </div>
                    <div className="col-75">
                        <input type="text" id="bottlePressure" name="bottlePressure" placeholder="200" defaultValue="200"/>
                    </div>
                </div>
                <div className="row">
                    <div className="col-25">
                        <label htmlFor="volume">Volume de la bouteille</label>
                    </div>
                    <div className="col-75">
                        <select id="volume" name="volume">
                        <option value="9L">9 L</option>
                        <option value="12L">12 L</option>
                        <option value="15L">15 L</option>
                        <option value="18L">18 L</option>
                        </select>
                    </div>
                </div>
                <div className="row">
                    <div className="col-25">
                        <label htmlFor="depth">Profondeur maxi</label>
                    </div>
                    <div className="col-75">
                        <input type="text" id="depth" name="depth" placeholder="0"/>
                    </div>
                </div>
                <div className="row">
                    <div className="col-25">
                        <label htmlFor="depthDuration">Durée de plongée</label>
                    </div>
                    <div className="col-75">
                        <input type="text" id="depthDuration" name="depthDuration" placeholder="0"/>
                    </div>
                </div>
                <div className="row">
                    <input type="submit" value="Submit"/>
                </div>
                <div hidden={errorState ? "" : "hidden"}><p>{errorMessage}</p></div>
            </form>
        )
}