import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import NoPost from "./noPost";

const UserPost = () => {

    const [posts, setPosts] = useState([]);
    return (
        <div>
            {
                posts.length == 0
                    ?
                    <NoPost text={"Тут пусто"}/>

                    : null
            }
        </div>
    )
}


if (document.getElementById('react-user-post')) {
    ReactDOM.render(<UserPost/>, document.getElementById('react-user-post'));
}
