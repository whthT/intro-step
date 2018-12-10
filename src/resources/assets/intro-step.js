if (!window.IntroStep) {
    throw new Error("There is no IntroStep variable here!");
}

import axios from "axios";

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    axios.defaults.headers.common['Accept'] = "application/json, text/javascript, */*; q=0.01";
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


class _IntroStep {
    constructor(IntroStep) {
        this.$model = new introJs();

        this.modelOnEventHandlers();

        this.IntroStep = IntroStep;

        this.step = this.getStep();
        this.user = this.getUserOrMock();
        this.stepsList = this.getStepsList();
        this.options = this.getOptions();

        this.is_completed = false;
        this.last_seen_step = this.user.last_step;

        this.placementsVariablesToModel();
        this.setCustomHtmlAttributes();

        if (this.isIntroWillShow()) {
            this.run();
        }
    }

    placementsVariablesToModel() {
        this.$model.setOption("steps", this.stepsList);
        this.$model.setOptions(this.options);
    }

    setCustomHtmlAttributes() {
        this.stepsList.forEach((item, key) => {
            let elem = document.querySelectorAll(item.element);
            Object.keys(elem).map(v => elem[v]).forEach(el => el.setAttribute("data-intro", key + 1));
        });
    }

    getStep() {
        return this.IntroStep.step;
    }

    getOptions() {
        return this.IntroStep.step.step_info.options;
    }

    getStoreRoute() {
        return this.IntroStep.route;
    }

    getStepsList() {
        return this.IntroStep.step.step_info.steps;
    }

    getUserLastStep() {
        return this.user.last_step;
    }

    getClientLastStep() {
        return this.last_seen_step;
    }

    getUserOrMock() {
        return this.IntroStep.user || {
            id: null,
            user_id: null,
            intro_step_step_list_id: this.step.id,
            is_completed: false,
            last_step: 0,
            last_action: null,
            created_at: null,
            updated_at: null,
            completed_at: null,
            is_mock: true
        }
    }

    isAuthOnly() {
        return this.step.auth_only ? true : false;
    }

    isUserExists() {
        return !this.user.is_mock ? true : false;
    }

    isUserAuth() {
        return this.IntroStep.is_auth ? true : false;
    }

    isStepActive() {
        return this.IntroStep.is_active ? true : false;
    }

    isCompletedBefore() {
        return this.user.is_completed ? true : false;
    }

    isCompleted() {
        return this.is_completed;
    }

    isIntroWillShow() {
        return this.isStepActive() && (
            this.isUserAuth() && !this.isCompletedBefore() || !this.isUserAuth() && !this.isAuthOnly()
        );
    }

    onChange(elem) {
        this.last_seen_step = elem.getAttribute("data-intro")

        console.log("change", this.last_seen_step);
    }

    onCompleted(_e) {
        this.is_completed = true;
    }

    onExit(_e) {
        if (this.isUserAuth()) {
            this.sendRequest();
        } else {
            // localStorage actions ....
        }
    }

    sendRequest() {
        axios.post(this.getStoreRoute(), {
            step_id: this.step.id,
            completed: this.isCompleted(),
            last_step: this.getClientLastStep()
        });
    }

    modelOnEventHandlers() {
        this.$model.oncomplete(evt => this.onCompleted(evt)); // On Completed
        this.$model.onexit(evt => this.onExit(evt)); // On Exit
        this.$model.onchange(elem => this.onChange(elem)); // On Change
    }

    run() {
        setTimeout(() => {
            this.$model.start();
            if (this.getUserLastStep()) {
                setTimeout(() => {
                    this.$model.goToStep(this.getUserLastStep());
                }, 100);
            }
        }, 1000);
    }

}

if (window.IntroStep.is_active && typeof introJs != "undefined") {
    new _IntroStep(window.IntroStep);
}
// window.IntroStep = null;
