import { createRouter, createWebHistory } from "vue-router";
import Index from "../views/pages/Index.vue";
import { UserLogin, UserRegister } from "@/views/auth";



const routes = [
   //user routes
   {
    path: "/auth/login",
    name: "user.login",
    component: UserLogin,
    meta: { title: "Login", guest: true },
  },
   {
    path: "/auth/register",
    name: "user.register",
    component: UserRegister,
    meta: { title: "Register", guest: true },
  },

    {
      path: "/",
      name: "index.page",
      component: Index,
      meta: { title: "Home" },
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
    scrollBehavior() {
      // always scroll to top
      return { top: 0, behavior: "smooth" };
    },
  });

  const DEFAULT_TITLE = "404";

  router.beforeEach((to, from, next) => {
    document.title = to.meta.title || DEFAULT_TITLE;
      next();
    
  })

export default router;