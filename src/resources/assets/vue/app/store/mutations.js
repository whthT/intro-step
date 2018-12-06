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
    setOptions(state, {opts}) {
        state.options = opts;
    },
    appendShowList(state, {item}) {
        state.showList.push(item);
    },
    appendEditList(state, {item}) {
        state.editList.push(item)
    },
    removeFromEditList(state, item) {
        state.editList.splice(state.editList.findIndex(v => v.id == item.id), 1);
    },
    removeFromShowList(state, item) {
        state.showList.splice(state.showList.findIndex(v => v.id == item.id), 1);
    },
}