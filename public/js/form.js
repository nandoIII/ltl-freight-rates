validar.validateForm = {};
// ready event
	validar.validateForm.ready = function() {
	  // selector cache
  var
    $LTLForm      = $('.form-ltl .ui.form'),
    // alias
    handler
  ;
  // event handlers
  handler = {

  };
  //;
 // $dropdown
 // .dropdown()
  //;

  $.fn.form.settings.onSuccess = function() {
  // alert('Valid form!');
    return false;
  };

  $.fn.form.settings.defaults = {
    
    name: {
      identifier  : 'name',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter you name'
        }
      ]
    },
    phone: {
      identifier  : 'phone',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please select a phone number'
        }
      ]
    },
    company: {
      identifier  : 'company',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter the company name'
        }
      ]
    },
	email: {
      identifier : 'email',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter your email'
        },
        {
          type   : 'email',
          prompt : 'Please enter a valid email'
        }
      ]
    },
	ozip: {
      identifier : 'ozip',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a valid origin zip code'
        }
      ]
    },
	
	 dzip: {
      identifier : 'dzip',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a valid destination zip code'
        }
      ]
    },
	
	
	weight: {
      identifier : 'weight',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter the weight'
        }
      ]
    },
	
    class: {
      identifier : 'class',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a valid class'
        }
      ]
    },
	
	dlong: {
      identifier : 'dlong',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a valid dimmension: lenght'
        }
      ]
    },
	
	dwidht: {
      identifier : 'dwidht',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a valid dimmension: widht'
        }
      ]
    },
	
	dheight: {
      identifier : 'dheight',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a valid dimmension: height'
        }
      ]
    },
	
    dunits: {
        identifier  : 'dunits',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please select a unit of measure'
          }
        ]
      },
	 }
	 };
	
	