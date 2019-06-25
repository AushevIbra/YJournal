import React from 'react';
import {ListVacancy} from '../index'

const data = [
    {
        title: "test",
        date: new Date(),
        image: 'https://habrastorage.org/getpro/moikrug/uploads/company/100/006/577/6/logo/medium_3db131842622cb9da4b6ade6bc0e00f4.jpg',
        priceFrom: 10000,
        priceTo: 20000,
        price: null,
        description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n" +
            "\n",
        district: "Массандра",
        city: "Ялта",
        address: "Aushev, 25",
    },

    {
        title: "test 2",
        date: new Date(),
        image: 'https://habrastorage.org/getpro/moikrug/uploads/company/100/006/577/6/logo/medium_3db131842622cb9da4b6ade6bc0e00f4.jpg',
        priceFrom: 10000,
        priceTo: 20000,
        price: null,
        description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n" +
            "\n",
        district: "Массандра",
        city: "Ялта",
        address: "Aushev, 25",
    },

    {
        title: "test 3",
        date: new Date(),
        image: 'https://habrastorage.org/getpro/moikrug/uploads/company/100/006/577/6/logo/medium_3db131842622cb9da4b6ade6bc0e00f4.jpg',
        priceFrom: 10000,
        priceTo: 20000,
        price: 10000,
        description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n" +
            "\n",
        district: "Массандра",
        city: "Ялта",
        address: "Aushev, 25",
    },
];
export default () => {
    return (
        <div className="card-panel light lighten-5 z-depth-1 no-shadow widget">
            <div className="card-header flex justify-content-between">
                <span>
                    Найдено 113 вакансий
                </span>

                <a href="#">Добавить</a>
            </div>

            <div className="card-body">
                <ul className="collection no-border">
                    {data.map(item => <ListVacancy key={item.title} {...item} />)}
                </ul>
            </div>
        </div>
    )
}
