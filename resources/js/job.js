import React from 'react';
import ReactDOM from 'react-dom';
import {Scope, Vacancy} from './jobs/components'
const Job = () => {
    return (
        <div className="row">

            <div className="col m9 s12">
                <Vacancy />
            </div>

            <div className="col m3 s12">
                <div className="card-panel light lighten-5 z-depth-1 no-shadow widget mb-5">
                    <div className="row valign-wrapper" style={{wordBreak: 'break-word', overflow: 'hidden'}}>
                        <div className="col s12">
                            <div className="center"><span className="black-text" style={{fontSize: "0.9em", fontWeight: 500}}>ДЕЯТЕЛЬНОСТЬ</span></div>
                            <Scope/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

if (document.getElementById('react-job')) {
    ReactDOM.render(<Job/>, document.getElementById('react-job'));
}

