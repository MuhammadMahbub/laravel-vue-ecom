import { createRouter, createWebHistory } from "vue-router";
import { Index, Shop, SingleProduct, Checkout } from "@/views/pages";
import { SellerApply, SellerPage, SellerStore } from "@/views/pages/seller";
import { UserLogin, UserRegister } from "@/views/auth";
import { MyProfile, MyOrderList, MyWishlist } from "@/views/user";



const routes = [
   //user routes
   {
    path: "/auth/login",
    name: "user.login",
    component: UserLogin,
    meta: { title: "Login" },
  },
   {
    path: "/auth/register",
    name: "user.register",
    component: UserRegister,
    meta: { title: "Register", guest: true },
  },
  {
    path: "/my/profile",
    name: "user.profile",
    component: MyProfile,
    meta: { title: "profile", requiresAuth: true },
  },
  {
    path: "/my/wishlist",
    name: "user.wishlist",
    component: MyWishlist,
    meta: { title: "wishlist", requiresAuth: true },
  },

  {
    path: "/my/orders",
    name: "user.orders",
    component: MyOrderList,
    meta: { title: "orders", requiresAuth: true },
  },


    {
      path: "/",
      name: "index.page",
      component: Index,
      meta: { title: "Home" },
    },
    {
      path: "/shop",
      name: "shop.page",
      component: Shop,
      meta: { title: "Shop" },
    },
    {
      path: "/product",
      name: "product.details",
      component: SingleProduct,
      meta: { title: "product" },
    },
    {
      path: "/seller-list",
      name: "seller.page",
      component: SellerPage,
      meta: { title: "seller-list" },
    },
    {
      path: "/checkout",
      name: "checkout.page",
      component: Checkout,
      meta: { title: "checkout" },
    },
    {
      path: "/seller-apply",
      name: "seller.apply",
      component: SellerApply,
      meta: { title: "seller-apply" },
    },
    {
      path: "/seller-store",
      name: "seller.store",
      component: SellerStore,
      meta: { title: "seller-store" },
    },
    
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