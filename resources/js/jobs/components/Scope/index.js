import React, {useState, useEffect} from 'react';
import { ListScopes } from '../index'

const scopes = [
    {
        title: "ИТ",
    },
    {
        title: "Туризм",
    },
    {
        title: "Кухня",
    },
    {
        title: "Административный персонал",
    },
    {
        title: "Банки, инвестиции, лизинг",
    },
]
export default () => {
    return (
        <div className="row">
            {scopes.map(item => <ListScopes key={item.title} title={item.title}/>)}
        </div>
    )
}
