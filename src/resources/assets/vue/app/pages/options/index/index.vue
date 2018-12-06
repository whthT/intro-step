<template>
  <div>
    <h6>Default Options</h6>
    <form @submit="saveDefaultOptions">
      <div class="row">
        <div class="col-md-6" v-for="item in formItems" :key="item.model">
          <div class="form-group" :class="{'form-check':item.type == 'boolean'}">
            <input
              type="checkbox"
              :id="item.model+'Element'"
              class="form-check-input"
              v-if="item.type == 'boolean'"
              v-model="options[item.model]"
            >
            <label :for="item.model+'Element'" v-text="item.label"></label>
            <input
              class="custom-input"
              :id="item.model+'Element'"
              v-model="options[item.model]"
              :type="item.type"
              v-if="['text', 'number', 'float'].indexOf(item.type) >= 0"
            >
            <select
              :id="item.model+'Element'"
              v-if="item.type == 'enum'"
              class="custom-input"
              v-model="options[item.model]"
            >
              <option value selected disabled>Click here for select.</option>
              <option :value="opt" :key="opt" v-for="opt in item.options" v-text="opt"></option>
            </select>
          </div>
        </div>
      </div>
      <div class="m-2">
        <button type="submit" class="btn btn-success">Save Default Options</button>
      </div>
    </form>
  </div>
</template>
<script>
import {mapState} from "vuex";
export default {
  data: () => ({
    options: {},
    formItems: [
      { label: "Next label", model: "nextLabel", type: "text" },
      { label: "Prev label", model: "prevLabel", type: "text" },
      { label: "Skip label", model: "skipLabel", type: "text" },
      { label: "Done label", model: "doneLabel", type: "text" },
      {
        label: "Tooltip position",
        model: "tooltipPosition",
        type: "enum",
        options: ["top", "bottom", "left", "right"]
      },
      { label: "Tooltip class", model: "tooltipClass", type: "text" },
      { label: "Higlight class", model: "highlightClass", type: "text" },
      { label: "Scroll to", model: "scrollTo", type: "text" },
      { label: "Scroll padding", model: "scrollPadding", type: "number" },
      { label: "Overlay opacity", model: "overlayOpacity", type: "float" },
      {
        label: "Helper element padding",
        model: "helperElementPadding",
        type: "number"
      },
      {
        label: "Hint position",
        model: "hintPosition",
        type: "enum",
        options: [
          "top-left",
          "top-middle",
          "top-right",
          "bottom-left",
          "bottom-middle",
          "bottom-right"
        ]
      },
      { label: "Hint button label", model: "hintButtonLabel", type: "text" },
      { label: "Button class", model: "buttonClass", type: "text" },
      {
        label: "Exit on overlay click",
        model: "exitOnOverlayClick",
        type: "boolean"
      },
      {
        label: "Keyboard navigation",
        model: "keyboardNavigation",
        type: "boolean"
      },
      { label: "Hide prev", model: "hidePrev", type: "boolean" },
      { label: "Hide next", model: "hideNext", type: "boolean" },
      { label: "Exit on ESC", model: "exitOnEsc", type: "boolean" },
      { label: "Hint animation", model: "hintAnimation", type: "boolean" },
      {
        label: "Disable interaction",
        model: "disableInteraction",
        type: "boolean"
      },
      {
        label: "Scroll to element",
        model: "scrollToElement",
        type: "boolean"
      },
      { label: "Show buttons", model: "showButtons", type: "boolean" },
      { label: "Show bullets", model: "showBullets", type: "boolean" },
      { label: "Show progress", model: "showProgress", type: "boolean" },
      {
        label: "Show step numbers",
        model: "showStepNumbers",
        type: "boolean"
      }
    ]
  }),
  computed: {
    ...mapState({
      vuexOptions: state => state.options
    })
  },
  mounted() {
    if(!Object.keys(this.vuexOptions).length) {
      Api.getIntroStepOptions().then(resp => {
        this.$store.commit("setOptions", {opts: resp});
        this.options = resp;
      });
    } else {
      this.options = this.vuexOptions;
    }
  },
  methods: {
    saveDefaultOptions(e) {
      e.preventDefault();
      Api.saveDefaultOptions(this.options)
        .then(data => {
          this.$store.commit("setOptions", {opts: this.options});
          this.$router.push({ name: "dashboard.index" });
          this.$toasted.show(data.message, {
            theme: "toasted-primary",
            position: "top-right",
            duration: 5000
          });
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>
