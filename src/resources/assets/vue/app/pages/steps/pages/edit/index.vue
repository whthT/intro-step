<template>
  <div>
    <form @submit="createNewStep">
      <div class="form-group">
        <input
          type="text"
          :class="{'invalid': errorList.name.length}"
          v-model="form.name"
          class="custom-input"
          name="name"
          id="name"
          :placeholder="$t('stepNamePlaceholder')"
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
          :placeholder="$t('viewPathPlaceholder')"
        >
        <small
          class="form-text text-danger"
          v-if="errorList.view_path.length"
          v-text="errorList.view_path.slice().shift()"
        ></small>
      </div>

      <div class="form-group form-check">
        <input type="checkbox" id="authOnly" class="form-check-input" v-model="form.auth_only">
        <label for="authOnly">{{$t('authOnlyLabel')}}</label>
        <small
          class="form-text text-danger"
          v-if="errorList.auth_only.length"
          v-text="errorList.auth_only.slice().shift()"
        ></small>
      </div>

      <div class="form-group">
        <small
          class="form-text text-danger"
          v-if="errorList.steps.length"
          v-text="errorList.steps.slice().shift()"
        ></small>
        <label>
          <b>{{$t('stepsLabel')}}</b>
        </label>
        <a href="#" @click="addNewStep" class="btn btn-success btn-rounded fa fa-plus-circle"></a>
        <span v-if="removedSteps.length">
          <a title="Undelete last step" @click="reDeleteStep" href="#" style="font-size:22px">
            <i class="fa fa-undo"></i>
          </a>
        </span>
        <a href="#" data-toggle="collapse" data-target="#step_list">{{$t('collapseText')}}</a>
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
                      <span>{{$t('elementSelectorText')}}:</span>
                      <input
                        type="text"
                        v-model="step.selector"
                        class="custom-input"
                        :class="['_'+step.uuid]"
                        :placeholder="$t('elementSelectorPlaceholder')"
                      >
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <span>{{$t('introText')}}:</span>
                      <input
                        class="custom-input"
                        v-model="step.intro"
                        :placeholder="$t('introTextPlaceholder')"
                      >
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div
                      class="form-group form-check inline-form-items"
                      :key="step.uuid+'_'+pos"
                      v-for="pos in positions"
                    >
                      <input
                        type="checkbox"
                        class="form-check-input"
                        :id="step.uuid+'_'+pos+'_checkbox'"
                        :value="step.position[pos]"
                        v-model="step.position[pos]"
                      >
                      <label
                        class="form-check-label"
                        :for="step.uuid+'_'+pos+'_checkbox'"
                      >{{$t(pos)}}</label>
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
        v-for="(item, model) in defaultOptions"
        :class="{'form-check':item.type == 'boolean'}"
        :key="model"
      >
        <input
          type="checkbox"
          :id="model+'Element'"
          class="form-check-input"
          :class="{'invalid': errorList[model].length}"
          v-if="fieldTypes.checkbox.indexOf(item.type) >= 0"
          v-model="form.options[model]"
        >
        
        <label
          :class="{'text-danger': errorList[model].length}"
          :for="model+'Element'"
          v-text="$t(model+'Label')"
        ></label>
        <input
          class="custom-input"
          :class="{'invalid': errorList[model].length}"
          :id="model+'Element'"
          v-model="form.options[model]"
          :type="item.type"
          v-if="fieldTypes.input.indexOf(item.type) >= 0"
        >
        <select
          :id="model+'Element'"
          v-if="fieldTypes.select.indexOf(item.type) >= 0"
          class="custom-input"
          :class="{'invalid': errorList[model].length}"
          v-model="form.options[model]"
        >
          <option value selected disabled>Click here for select.</option>
          <option :value="opt" :key="opt" v-for="opt in item.options" v-text="opt"></option>
        </select>
        
        <small
          class="form-text text-danger"
          v-if="errorList[model].length"
          v-text="errorList[model].slice().shift()"
        ></small>
      </div>

      <button type="submit" class="btn btn-success">{{$t('editStepLabel')}}</button>
    </form>
  </div>
</template>
<script>
import uuid from "uuid/v4";
import { mapState } from "vuex";
export default {
  data() {
    return {
      positions: ["left", "right", "top", "bottom"],
      fieldTypes: {
        input: ["text", "number", "numeric", "integer"],
        checkbox: ["boolean"],
        select: ["enum"]
      },
      removedSteps: [],
      form: {
        name: "",
        view_path: "",
        auth_only: false,
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
        options: [],
        auth_only: [],
        nextLabel: [],
        prevLabel: [],
        skipLabel: [],
        doneLabel: [],
        hintButtonLabel: [],
        tooltipPosition: [],
        tooltipClass: [],
        highlightClass: [],
        hidePrev: [],
        hideNext: [],
        showStepNumbers: [],
        keyboardNavigation: [],
        showButtons: [],
        showBullets: [],
        showProgress: [],
        scrollToElement: [],
        scrollPadding: [],
        overlayOpacity: [],
        disableInteraction: [],
        helperElementPadding: [],
        hintPosition: [],
        hintAnimation: [],
        buttonClass: [],
        exitOnEsc: [],
        exitOnOverlayClick: []
      }
    };
  },
  computed: {
    ...mapState({
      vuexOptions: state => state.options,
      editList: state => state.editList,
      defaultOptions: state => state.defaultOptions
    })
  },
  mounted() {
    this.getStepInfo(this.$route.params.id);
  },
  methods: {
    getStepInfo(id) {
      Api.getStepInfoById(id)
        .then(resp => {
          this.form = {
            id: resp.data.id,
            name: resp.data.name,
            view_path: resp.data.view_path,
            auth_only: resp.data.auth_only,
            steps: resp.data.step_info.steps.map(v => {
              let position = {};
              v.position.forEach(v => (position[v] = true));
              return {
                uuid: uuid(),
                selector: v.element,
                intro: v.intro,
                position
              };
            }),
            options: {
              ...this.defaultOptions,
              ...resp.data.step_info.options
            }
          };
          this.$store.commit("appendEditList", { item: this.form });
        })
        .catch(err => window.alert(err.toString()));
    },
    addNewStep(e) {
      e.preventDefault();
      let _uuid = uuid();
      this.form.steps.push({
        uuid: _uuid,
        selector: "",
        intro: "",
        position: { left: true, right: true, bottom: true, top: true }
      });
      this.$nextTick(() => {
        document.querySelector("._" + _uuid).focus();
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
      let form = { ...this.form, ...this.form.options };
      form.steps = form.steps.map(v => ({
        ...v,
        position: Object.keys(v.position).filter(c => v.position[c])
      }));

      Api.updateStep(form)
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

            this.$toasted.show(err.response.data.message, {
              theme: "toasted-primary",
              position: "top-right",
              duration: 5000
            });

            let errs = [];
            Object.keys(this.errorList).forEach(
              prop => (errs = errs.concat(this.errorList[prop]))
            );
            this.$toasted.show(errs.slice(0, 4).join("<br />"), {
              theme: "toasted-primary",
              position: "top-right",
              duration: 5000
            });
          }
        });
    }
  }
};
</script>