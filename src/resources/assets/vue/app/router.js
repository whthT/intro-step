import VueRouter from "vue-router";

import RouterView from "./pages/index";
import DashboardHome from "./pages/dashboard/pages/home/index";

import StepsIndex from "./pages/steps/pages/index/index";
import CreateStep from "./pages/steps/pages/create/index";
import EditStep from "./pages/steps/pages/edit/index";
import ShowStep from "./pages/steps/pages/show/index";


import OptionsIndex from "./pages/options/index/index";

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
            label: "Dashboard",
            icon: "home",
            showOnSidebar: true,
            beforeEnter: auth,
            children: [{
                path: "",
                component: DashboardHome,
                name:"dashboard.index",

                meta: {
                    breadcrumbs: [{
                        name: "Dashboard",
                        path: "/"
                    }],
                    title: "Dashboard"
                }
            }],
            meta: {
                breadcrumbs: [{
                    name: "Dashboard",
                    path: "/"
                }],
                title: "Dashboard"
            }
        },
        {
            path: "/step-info/:id",
            name: "step-info.show",
            showOnSidebar: false,
            component: StepInfoShow, 
            meta: {
                breadcrumbs: [
                    {name: "Dashboard", path: "/"},
                    {name: "Step Info"}
                ],
                title: "Step Info"
            }
        },
        {
            path: "/steps",
            label: "Steps",
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
                                name: "Dashboard",
                                path: "/"
                            },
                            {
                                name: "Steps",
                                path: "/steps"
                            }
                        ],
                        title: "Steps"
                    }
                },
                {
                    path: "create",
                    component: CreateStep,
                    name: "steps.create",
                    meta: {
                        breadcrumbs: [{
                                name: "Dashboard",
                                path: "/"
                            },
                            {
                                name: "Steps",
                                path: "/steps"
                            },
                            {
                                name: "Create",
                                path: "/steps/create"
                            }
                        ],
                        title: "Create New Step"
                    }
                },
                {
                    path: ":id/edit",
                    component: EditStep,
                    name: "steps.edit",
                    meta: {
                        breadcrumbs: [{
                                name: "Dashboard",
                                path: "/"
                            },
                            {
                                name: "Steps",
                                path: "/steps"
                            }, {
                                name: "Edit"
                            }
                        ],
                        title: "Edit Step"
                    }
                },
                {
                    path: ":id",
                    component: ShowStep,
                    name: "steps.show",
                    meta: {
                        breadcrumbs: [{
                                name: "Dashboard",
                                path: "/"
                            },
                            {
                                name: "Steps",
                                path: "/steps"
                            }, {
                                name: "Show"
                            }
                        ],
                        title: "Step Info"
                    }
                },
            ]
        },
        {
            path: "/options",
            label: "Default Options",
            component: RouterView,
            showOnSidebar: true,
            icon: "settings",
            children: [
                {path: "/", component: OptionsIndex, name: "options.index", meta: {
                    breadcrumbs: [
                        {name: "Dashboard", path: "/"},
                        {name: "Default Options"}
                    ],
                    title: "Default Options"
                }}
            ]
        }
    ]
})
