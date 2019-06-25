import React from 'react';

const ListVacancy = ({title, image, date, priceFrom, priceTo, price, description, district, city, address}) => {
    return (
        <li className="collection-item avatar">
            <img src={image} alt="" className="circle"/>
            <a className="title">{title}</a>
            <p className="black-text">
                {description.substr(0, 150)}
                <br/>
                <span className="grey-text">{`${district}, ${city}, ${address}`}</span>
                <br/>
                <span className="green-text"><b> {!price ? `от ${priceFrom} до ${priceTo}` : price }  руб.</b></span>
            </p>
            <a href="javascript:;" className="secondary-content">{getTime(date)}</a>
            <div className="divider"></div>
        </li>
    )
}

export default ListVacancy;
