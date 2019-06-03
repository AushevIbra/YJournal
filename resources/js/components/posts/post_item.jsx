import React, {useState} from 'react'
import api from '../../config/api'

const PostItem = ({item, addClass, setLike, setDisslike}) => {
    const [active, setActive] = useState(false);
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
        <div className="card" data-id-card={item.id}>
            <div className="card-meta clearfix">
                <a href="#" className="card-meta-profile">
                    <span className="card__desc-avatar" style={{background: `url('${item.user.avatar}')`}}></span>
                    <span className="card__desc-name">{item.user.name}</span>
                </a>
                <span className="card__desc-date">{date}  </span>
                {window.user.id === item.user_id
                &&
                <div className="post-options">
                    <div className="post-option-control" onClick={() => {
                        setActive(!active)
                    }}>
                        <svg id="dots" width="18" height="4" viewBox="0 0 18 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="2" cy="2" r="2"></circle>
                            <circle cx="9" cy="2" r="2"></circle>
                            <circle cx="16" cy="2" r="2"></circle>
                        </svg>
                    </div>
                    <div className={`post-options-dropdown wb ${active ? 'active' : null}`} data-id={item.id}>
                        <a className="bl" href={`/post/${item.slug}/edit`}>Изменить</a>
                        <a href="javascript://" className="bl" onClick={api.deletePost.bind(this, item.id)}>Удалить</a>
                    </div>
                </div>}
            </div>
            <div className="card-content">
                <h2 className="card-title"><a href={`/post/${item.slug}`} className="black-text">{item.title}</a></h2>
            </div>
            {item.attach && <div className="attach" dangerouslySetInnerHTML={{__html: item.attach}}></div>}

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
