const initialState = {
    items: [],
    user: null,
}

const liveComments = (state = initialState, action) => {
    switch (action.type) {
        case "SET_LIVE_COMMENTS":
            return {
                ...state,
                items: action.comments
            };
        case "APPEND_LIVE_COMMENT":
            return {
                ...state,
                items: [action.comment, ...state.items]
            };
        default:
            return state
    }
}

export default liveComments
