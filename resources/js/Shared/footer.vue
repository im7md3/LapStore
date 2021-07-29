<template>
    <footer>
        <div class="footer-content container">
            
            <div class="made-with">Made with <i class="fa fa-heart"></i> by Andre Madarang</div>
            <ul>
                <li>Follow Me:</li>
                <li><a href="#"><i class="fa fa-globe"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa fa-github"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            </ul>
        </div> <!-- end footer-content -->
</footer>
</template>

<script>
    export default {

    }

</script>

<style >
.container {
  max-width: 950px;
  margin: auto;
}
    footer {
        background: #535353;
        color: #e9e9e9;
        padding: 40px 0;
    }

    footer .footer-content {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    footer .footer-content ul {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        width: 30%;
    }

    footer .footer-content ul a {
        color: #e9e9e9;
    }

    @media only screen and (max-width: 992px) {
  

  footer .footer-content {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
  }

  footer .footer-content .made-with {
    margin: auto;
  }

  footer .footer-content ul {
    margin: 20px auto;
    width: 60%;
  }
}

</style>
