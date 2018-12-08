import VueRouter from "vue-router";

import RouterView from "./pages/index";
import DashboardHome from "./pages/dashboard/pages/home/index";

import StepsIndex from "./pages/steps/pages/index/index";
import CreateStep from "./pages/steps/pages/create/index";
import EditStep from "./pages/steps/pages/edit/index";
import ShowStep from "./pages/steps/pages/show/index";

import StepInfoShow from "./pages/step-info/index";

const auth = (to, from, next) => {
    // if (!localStorage.getItem('jwt')) {
    //     return router.push({ name: 'login' });
    // }
    // console.log("middleware")

    return next();
};


export default new VueRouter({
    routes: [{
            path: "/",
            component: RouterView,
            label: "dashboardLabel",
            icon: "home",
            showOnSidebar: true,
            beforeEnter: auth,
            children: [{
                path: "",
                component: DashboardHome,
                name:"dashboard.index",

                meta: {
                    breadcrumbs: [{
                        name: "dashboardLabel",
                        path: "/"
                    }],
                    title: "dashboardLabel"
                }
            }],
            meta: {
                breadcrumbs: [{
                    name: "dashboardLabel",
                    path: "/"
                }],
                title: "dashboardLabel"
            }
        },
        {
            path: "/step-info/:id",
            name: "step-info.show",
            showOnSidebar: false,
            component: StepInfoShow, 
            meta: {
                breadcrumbs: [
                    {name: "dashboardLabel", path: "/"},
                    {name: "stepInfoLabel"}
                ],
                title: "stepInfoLabel"
            }
        },
        {
            path: "/steps",
            label: "stepsLabel",
            component: RouterView,
            icon: "file",
            showOnSidebar: true,
            beforeEnter: auth,
            children: [{
                    path: "",
                    component: StepsIndex,
                    name: "steps.index",
                    meta: {
                        breadcrumbs: [{
                                name: "dashboardLabel",
                                path: "/"
                            },
                            {
                                name: "Steps",
                                path: "/steps"
                            }
                        ],
                        title: "stepsLabel"
                    }
                },
                {
                    path: "create",
                    component: CreateStep,
                    name: "steps.create",
                    meta: {
                        breadcrumbs: [{
                                name: "dashboardLabel",
                                path: "/"
                            },
                            {
                                name: "stepsLabel",
                                path: "/steps"
                            },
                            {
                                name: "stepCreateLabel",
                                path: "/steps/create"
                            }
                        ],
                        title: "stepCreateLabel"
                    }
                },
                {
                    path: ":id/edit",
                    component: EditStep,
                    name: "steps.edit",
                    meta: {
                        breadcrumbs: [{
                                name: "dashboardLabel",
                                path: "/"
                            },
                            {
                                name: "stepsLabel",
                                path: "/steps"
                            }, {
                                name: "Edit"
                            }
                        ],
                        title: "editStepLabel"
                    }
                },
                {
                    path: ":id",
                    component: ShowStep,
                    name: "steps.show",
                    meta: {
                        breadcrumbs: [{
                                name: "dashboardLabel",
                                path: "/"
                            },
                            {
                                name: "stepsLabel",
                                path: "/steps"
                            }, {
                                name: "stepsShowLabel"
                            }
                        ],
                        title: "stepInfoLabel"
                    }
                },
            ]
        }
    ]
})
