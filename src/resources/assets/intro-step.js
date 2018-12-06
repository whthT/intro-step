if (!window.IntroStep) {
    throw new Error("There is no IntroStep variable here!");
}

import axios from "axios";

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


if (window.IntroStep.is_active && typeof introJs != "undefined") {
    const Intro = introJs();
    let options = {};
    Object.keys(window.IntroStep.step.step_info.options).forEach(opt => options[opt] = window.IntroStep.step.step_info.options[opt]);
    options.steps = IntroStep.user && IntroStep.user.last_step ? window.IntroStep.step.step_info.steps.slice(IntroStep.user.last_step) : window.IntroStep.step.step_info.steps;

        window.IntroStep.step.step_info.steps.forEach((item, key) => {
            let elem = document.querySelectorAll(item.element);
            Object.keys(elem).map(v => elem[v]).forEach(el => el.setAttribute("data-intro", key + 1));
        });


        Intro.setOptions(options);

    if (IntroStep.is_auth_only && IntroStep.is_auth) {

        

        if (!IntroStep.user || IntroStep.user && !IntroStep.user.is_completed || !IntroStep.user && !IntroStep.is_auth_only) {
            setTimeout(() => {
                Intro.start()
            }, 1000);
        }

        
        let last_step = IntroStep.user && IntroStep.user.last_step ? IntroStep.user.last_step : 0;
        let isCompleted = false;

        Intro.onchange(elem => last_step = elem.getAttribute("data-intro"));
        Intro.oncomplete(() => isCompleted = true);

        Intro.onexit(() => {
            axios.post("/intro-step-admin/api/user", {
                step_id: IntroStep.step.id,
                complete: isCompleted,
                last_step
            }).then().catch(console.log);
        })
    } else if (!IntroStep.is_auth) {
        // if (window.localStorage) {
        //     let storageIntro = JSON.parse(window.localStorage.getItem("intro_step_" + IntroStep.id)) || {};
        //     let last_step = storageIntro.last_step ? storageIntro.last_step : 0;
        //     Intro.onchange((elem) => {
        //         last_step = elem.getAttribute("data-intro");
        //     });

        //     function save() {
        //         storageIntro = {
        //             id: IntroStep.step.id,
        //             last_step,
        //             is_completed: true
        //         }
        //         window.localStorage.setItem("intro_step_" + IntroStep.step.id, JSON.stringify(storageIntro));
        //     }

        //     Intro.oncomplete(() => save());
        //     Intro.onexit(() => save());
        // }
    }
}
