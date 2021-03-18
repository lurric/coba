<?php
if (isset($success3)) { ?>
<script type="text/javascript">                 
$.notice({
    text: "<?php echo $success3; ?>",
    type: "success"
});
</script>
<?php
}
if (isset($success2)) { ?>
<script type="text/javascript">                 
$.notice({
    text: "<?php echo $success2; ?>",
    type: "success"
});
</script>
<?php
}
if (isset($success1)) { ?>
<script type="text/javascript">                 
$.notice({
    text: "<?php echo $success1; ?>",
    type: "success"
});
</script>
<?php
}
if (isset($fail3)) { ?>
<script type="text/javascript">  
$.notice({
    text: "<?php echo $fail3; ?>",
    type: "error"
});
</script>
<?php
}
if (isset($fail2)) { ?>
<script type="text/javascript">  
$.notice({
    text: "<?php echo $fail2; ?>",
    type: "error"
});
</script>
<?php
}
if (isset($fail1)) { ?>
<script type="text/javascript">  
$.notice({
    text: "<?php echo $fail1; ?>",
    type: "error"
});
</script>
<?php
}
if (isset($errorupld3)) { ?>
<script type="text/javascript">  
$.notice({
    text: "<?php echo $errorupld3; ?>",
    type: "error"
});
</script>
<?php
}
if (isset($errorupld2)) { ?>
<script type="text/javascript">  
$.notice({
    text: "<?php echo $errorupld2; ?>",
    type: "error"
});
</script>
<?php
}
if (isset($errorupld1)) { ?>
<script type="text/javascript">  
$.notice({
    text: "<?php echo $errorupld1; ?>",
    type: "error"
});
</script>
<?php
}
?>