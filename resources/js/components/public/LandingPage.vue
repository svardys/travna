<template>
    <div>
        <Menu></Menu>
        <router-view></router-view>
        <Footer></Footer>
    </div>
</template>

<script>
import Menu from './Menu';
import Footer from './Footer';
export default {
    components: {
        Menu,Footer
    }
}
</script>
