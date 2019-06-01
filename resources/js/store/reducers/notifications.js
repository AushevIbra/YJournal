const initialState = {
    items: [],
}

const notifications = (state = initialState, action) => {
    switch (action.type) {
        case "SET_NOTIFICATIONS":
            return {
                ...state,
                items: action.payload
            };

        default:
            return state
    }
}

export default notifications
