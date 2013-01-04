
<div id="forgot-pass" class="warning">
    
    <div id="popup_content">
        <?php
        
            echo '<p>' . $msg . '</p>';
            $yes = array(
                'name' => 'confirm',
                'id' => 'yes_button',
                'content' => 'Yes'
            );
            $no = array(
                'name' => 'cancel',
                'id' => 'no_button',
                'content' => 'No'
            );
            echo form_button($yes);
            echo form_button($no);
            
        
        ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('button#yes_button').click(function() {
            $.ajax({
               url: '<?= base_url(); ?>ajax/reset_pass',
               method:'POST',
               data:({email:'<?= $email; ?>'}),
               success:function(data){
                   
                   if(data == '1') {
                       window.location = '<?= base_url(); ?>auth/login';
                   }else {
                       alert('There was an error. Please try again!');
                   }
               }
            })
        })
        
        $('button#no_button').click(function() {
            window.location = '<?= base_url(); ?>auth/login';
        })
    })
</script>