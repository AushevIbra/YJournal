import React from 'react'

const PostItem = ({item, addClass, setLike, setDisslike}) => {
    const date = getTime(item.created_at);

    const convertHtmlToText = html => {
        let elem = document.createElement('div');
        elem.innerHTML = html;
        elem.setAttribute("id", `card__content-${item.id}`);
        elem.style = "display: none";
        window.$('body').append(elem);
        const id = elem.getAttribute('id');
        const text = window.$("#" + id).find("p,ul,ol").text();

        elem.remove();
        return text.length > 150 ? `${text.substr(0, 150)}...` : text;
    }
    const content = convertHtmlToText(item.content);
    return (
    <div className="card">
        <div className="card-content">
            <a href={`/post/${item.slug}`}><h2 className="card-title black-text">{item.title}</h2></a>

            <div className="card__desc">
                <a href={`/user/${item.user.id}`}>
                    <span className="card__desc-avatar" style={{background: `url('${item.user.avatar}')`}}></span>
                    <span className="card__desc-name">{item.user.name}</span>
                </a>
                <span className="card__desc-date">{date}  </span>
            </div>
        </div>
        {item.attach && <div className="card-image">
            <img src={item.attach}/>
        </div>}

        {content !== "" && <div className="card-content">{content}</div>}
        <div className="card-action card-info">
            <div>
                <span className="card__action-views"><i className="material-icons tiny">remove_red_eye</i> {item.views}</span>
                <span className="card__action-comments"><i className="material-icons tiny">question_answer</i> {item.count_comments_count}</span>
            </div>
            <div className="d-flex" style={{alignItems: 'center'}}>
                <a href="javascript:;" onClick={setDisslike} className="grey-text"><i className="material-icons">keyboard_arrow_down</i></a>
                <a href="" className="green-text">{item.rating}</a>
                <a href="javascript:;" onClick={setLike} className="grey-text"><i className="material-icons">keyboard_arrow_up</i></a>
            </div>
        </div>
    </div>
)
}

export default PostItem
