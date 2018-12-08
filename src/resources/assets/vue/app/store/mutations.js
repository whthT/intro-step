export default {
    setStepList(state, {list}) {
        state.stepList = list;
    },
    setRouterBackExists(state, {bool}) {
        state.isRouterBackExists = bool;
    },
    setStepUserList(state, {list}) {
        state.stepUserList = list;
    },
    appendShowList(state, {item}) {
        state.showList.push(item);
    },
    appendEditList(state, {item}) {
        state.editList.push(item)
    }
}