<template>
  <div>
    <h6>{{title}}</h6>
    <form @submit="createNewStep">
      <div class="form-group">
        <!-- <label for="name">Name</label> -->
        <input
          type="text"
          :class="{'invalid': errorList.name.length}"
          v-model="form.name"
          class="custom-input"
          name="name"
          id="name"
          placeholder="Step name"
        >
        <small
          class="form-text text-danger"
          v-if="errorList.name.length"
          v-text="errorList.name.slice().shift()"
        ></small>
      </div>

      <div class="form-group">
        <!-- <label for="view_path">View Path</label> -->
        <input
          type="text"
          :class="{'invalid': errorList.view_path.length}"
          v-model="form.view_path"
          class="custom-input"
          name="view_path"
          id="view_path"
          placeholder="Witch view must shown? Eq: frontend.home.index"
        >
        <small
          class="form-text text-danger"
          v-if="errorList.view_path.length"
          v-text="errorList.view_path.slice().shift()"
        ></small>
      </div>

      <div class="form-group">
        <small
          class="form-text text-danger"
          v-if="errorList.steps.length"
          v-text="errorList.steps.slice().shift()"
        ></small>
        <label>
          <b>Steps</b>
        </label>
        <a href="#" @click="addNewStep" class="btn btn-success btn-rounded fa fa-plus-circle"></a>
        <span v-if="removedSteps.length">
          <a title="Undelete last step" @click="reDeleteStep" href="#" style="font-size:22px">
            <i class="fa fa-undo"></i>
          </a>
        </span>
        <a href="#" data-toggle="collapse" data-target="#step_list">collapse</a>
        <ul class="list-style-none list-group collapse show" id="step_list">
          <draggable v-model="form.steps">
            <transition-group tag="li" name="flip-list">
              <li
                v-for="(step, key) in form.steps"
                class="list-style-none list-group-item draggable-item position-relative"
                :key="step.uuid"
              >
                <span class="badge badge-secondary step-key">#{{key+1}}</span>
                <div class="text-right">
                  <a
                    href="#"
                    @click="removeStep(step, $event)"
                    class="text-danger remove-step-item"
                  >
                    <i class="fa fa-times-circle-o"></i>
                  </a>
                </div>
                <div class="row" style="margin-bottom: -15px;">
                  <div class="col-md-3">
                    <div class="form-group">
                      <span>Element Selector:</span>
                      <input
                        type="text"
                        v-model="step.selector"
                        class="custom-input"
                        placeholder="#first_item"
                      >
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <span>Intro Text:</span>
                      <input
                        class="custom-input"
                        v-model="step.intro"
                        placeholder="The intro text."
                      >
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div
                      class="form-group form-check inline-form-items"
                      :key="step.uuid+'_'+pos.name"
                      v-for="pos in positions"
                    >
                      <input
                        type="checkbox"
                        class="form-check-input"
                        :id="step.uuid+'_'+pos.name+'_checkbox'"
                        :value="step.position[pos.name]"
                        v-model="step.position[pos.name]"
                      >
                      <label
                        class="form-check-label"
                        :for="step.uuid+'_'+pos.name+'_checkbox'"
                      >{{pos.label}}</label>
                    </div>
                  </div>
                </div>
              </li>
            </transition-group>
          </draggable>
        </ul>
      </div>

      <div
        class="form-group"
        v-for="item in formItems"
        :class="{'form-check':item.type == 'boolean'}"
        :key="item.model"
      >
        <input
          type="checkbox"
          :id="item.model+'Element'"
          class="form-check-input"
          v-if="item.type == 'boolean'"
          v-model="form.options[item.model]"
        >
        <label :for="item.model+'Element'" v-text="item.label"></label>
        <input
          class="custom-input"
          :id="item.model+'Element'"
          v-model="form.options[item.model]"
          :type="item.type"
          v-if="['text', 'number', 'float'].indexOf(item.type) >= 0"
        >
        <select
          :id="item.model+'Element'"
          v-if="item.type == 'enum'"
          class="custom-input"
          v-model="form.options[item.model]"
        >
          <option value selected disabled>Click here for select.</option>
          <option :value="opt" :key="opt" v-for="opt in item.options" v-text="opt"></option>
        </select>
      </div>
      <div class="m-3">
        <small
          class="form-text text-danger"
          v-if="errorList.options.length"
          v-text="errorList.options.slice().shift()"
        ></small>
      </div>

      <button type="submit" class="btn btn-success">Edit Step</button>
    </form>
  </div>
</template>
<script>
import uuid from "uuid/v4";
export default {
  data() {
    return {
      positions: [
        { label: "Left", name: "left" },
        { label: "Right", name: "right" },
        { label: "Bottom", name: "bottom" },
        { label: "Top", name: "top" }
      ],
      removedSteps: [],
      title: "Add New Step",
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
        { label: "Keyboard navigation", model: "keyboardNavigation", type: "boolean"},
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
      ],
      form: {
        name: "",
        view_path: "",
        steps: [
          {
            uuid: uuid(),
            selector: "",
            intro: "",
            position: { left: true, right: true, bottom: true, top: true }
          }
        ],

        options: {}
      },
      errorList: {
        name: [],
        view_path: [],
        steps: [],
        options: []
      }
    };
  },
  created() {
    this.getIntroStepOptions();
  },
  methods: {
    getIntroStepOptions() {
      Api.getIntroStepOptions().then(data => (this.form.options = data));
    },
    addNewStep(e) {
      e.preventDefault();
      this.form.steps.push({
        uuid: uuid(),
        selector: "",
        intro: "",
        position: { left: true, right: true, bottom: true, top: true }
      });
    },
    removeStep(step, $event) {
      $event.preventDefault();
      let index = this.form.steps.findIndex(v => v.uuid == step.uuid);
      if (index >= 0) {
        this.removedSteps.push(this.form.steps.splice(index, 1).shift());
      }
    },
    reDeleteStep($event) {
      $event.preventDefault();
      if (this.removedSteps.length) {
        this.form.steps.push(this.removedSteps.pop());
      }
    },
    createNewStep(e) {
      e.preventDefault();
      let form = this.form;
      form.steps = form.steps.map(v => ({
        ...v,
        position: Object.keys(v.position)
      }));

      Api.createNewStep(form)
        .then(data => {
          this.$router.push({ name: "steps.index" });
          this.$toasted.show(data.message, {
            theme: "toasted-primary",
            position: "top-right",
            duration: 5000
          });
        })
        .catch(err => {
          if (err.response.status == 422) {
            this.errorList = {
              ...this.errorList,
              ...err.response.data.errors
            };
          }
        });
    }
  }
};
</script>