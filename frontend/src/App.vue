<script setup>

import {HeaderPart,NavBar,CartSideBar,MobileMenu,NewsLetter,FooterPart} from '@/components';

</script>


<template>
  <div>
    <div class="backdrop"></div>
    <a class="backtop fas fa-arrow-up" href="#"></a>

<!-- header part  -->
<HeaderPart />
    

    <!-- navbar part  -->
    <NavBar />

    <CartSideBar />

<MobileMenu />
    

    

    <router-view></router-view>

    <NewsLetter />

    <FooterPart />
  </div>
</template>
