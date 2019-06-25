import React from 'react';

const ListScopes = ({title}) => (
    <p className="col s12 m12">
        <label>
            <input type="checkbox"/>
            <span>{title}</span>
        </label>
    </p>
)

export default ListScopes;
