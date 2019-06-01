const initialState = {
    items: [],
    comment: null, // for Reply,
    id: null,
    currentUser: null
}

const comments = (state = initialState, action) => {
    switch (action.type) {
        case "SET_COMMENTS":
            return {
                ...state,
                items: [...state.items, ...action.payload]
            };
        case "SET_USER":
            return {
                ...state,
                comment: action.comment // Массив с информацией о пользователе и комментарии
            };
        case "SET_ID_POST":
            return {
                ...state,
                id: action.id
            };
        case "SET_CURRENT_USER":
            return {
                ...state,
                currentUser: action.user
            }
        case "PUSH_COMMENT":
            if (action.comment[0].parent_id == 0) {
                return {
                    ...state,
                    items: [...action.comment, ...state.items]
                }
            } else {
                const arr = state.items.map(item => {
                    if(item.id == action.comment[0].parent_id) {
                        item.children_comments = [...item.children_comments, ...action.comment]
                        return item;
                    }
                    return item;
                })
                return {
                    ...state,
                    items: arr
                };



            }
            break;

        default:
            return state
    }
}

export default comments
