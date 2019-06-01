import React from 'react';
import ReactDOM from 'react-dom';
import Ask from "./components/asks/ask";

const Test = () => {
    return (
        <div>
            <Ask/>
        </div>
    )
}

if (document.getElementById('react-answer')) {
    ReactDOM.render(<Test/>, document.getElementById('react-answer'));
}

