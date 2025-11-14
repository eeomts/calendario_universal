var Loader = new Class({
	message: null,
	initialize: function(message){
		this.setMessage(message);
	},
	setMessage: function(message){
		if(!Default.isEmpty(message)) this.message = message;
	},
	show: function(){
		if(!Default.isEmpty(this.message)){
			this.message;
		} else {
			this.message = 'Por favor aguarde, processando...';
		}

		jQuery("body").prepend("<div id='ajax-loader'><div class='background'></div><div class='center text-center'><i class='fa fa-circle-o-notch fa-pulse fa-3x fa-fw'></i><br>"+this.message+"</div></div>");
		jQuery("#ajax-loader").hide().fadeIn('slow');
		//setTimeout(this.hide, 8000);
		console.log('show loader');
	},
	hide: function(){
		jQuery("#ajax-loader").show().fadeOut('slow',function(){
			this.remove();
		});        
		console.log('hide loader');
	}
});