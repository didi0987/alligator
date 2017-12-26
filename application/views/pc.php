
<script src="<?=base_url()?>res/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">

    function myFunction() {

        var pc=$('#pc').val();
        var url='<?=base_url()?>index.php/Nimda/good/'+pc;
        window.location.href=url;
    }

</script>
<body>

    <input name="q" type="text" id="pc" size="32" maxlength="128" class="txt"  >
    <input type="submit" id="hit" value="submit" onclick="myFunction()" class="btn">

</body>
