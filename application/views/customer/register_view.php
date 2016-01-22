<div class="row">
    <div class="span6 offset2">
        <div id="register_form_error" class="alert alert-error"><!-- Dynamic --></div>
        <form id="register_form" class="form-horizontal" method="POST" action="<?php echo site_url('customer/register') ?>">

            <div class="text-right"><h3>Register Customer</h3></div>

            <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input type="text" name="name" class="input-xlarge"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Phone</label>
                <div class="controls">
                    <input type="text" name="phone" class="input-xlarge"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                    <input type="text" name="email" class="input-xlarge" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Address</label>
                <div class="controls">
                    <input type="text" name="address" class="input-xlarge" />
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label">City</label>
                <div class="controls">
                    <input type="text" name="city" class="input-xlarge" />
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label">State</label>
                <div class="controls">
                    <input type="text" name="state" class="input-xlarge" />
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label">Country</label>
                <div class="controls">                            
                    <select name="country" id="country" class="selectpicker smallinput" tabindex="275" >
                        <option value="1">Usa</option>
                        <option value="2">Canada</option>
                    </select>                            
                </div>
            </div>


            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-blue btn-small" hidefocus="true" style="outline: medium none;"><span class="gradient">Save</span></button>
                    <a class="btn" href="<?php echo site_url('/') ?>">Cancel</a>
                </div>
            </div>      
        </form>        
    </div>
</div>
<script>
    $(function () {
        $("#register_form_error").hide();
        $('#register_form').submit(function (evt) {
            evt.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();
            $.post(url, postData, function (o) {
                if (o.result == 1) {
                    window.location.href = '<?php echo site_url('customer') ?>';
                } else {
                    $("#register_form_error").show();
                    var output = '<ul>';
                    for (var key in o.error) {
                        var value = o.error[key];
                        output += '<li>' + value + '</li>';
                    }
                    output += '</ul>';
                    $("#register_form_error").html(output);
                }
            }, 'json');
        });
    });
</script>