var Element = {

	new : function( name, props ) {
		if( name && typeof ( name ) === "string" ) {
			
			this.el = document.createElement( name );

			if( props && typeof ( props ) === "object" ) {
				var element = this.el;

				Object.keys( props ).forEach(function( key ) {

					if( typeof ( props[key] ) === "string" ) {

						element.setAttribute(key, props[key]);
					}
					
				});	
				return this;
			}
			else return this.el;
		}
		else return false;
	},

	attach : function( name ) {
		if( !this.el ) return false;

		if( name && typeof ( name ) === "string" ) {
		
		var handle = document.querySelector( name );
		if( handle !== null ) {
			return handle.appendChild(this.el);
		}

		} else {
			if( document.body !== null ) {
				return document.body.appendChild(this.el);
			}
		} 
	},

	remove : function( name ) {
		if( name && typeof ( name ) === "string" ) {

			var handle = document.querySelector( name );

			if( handle !== null ) {

				handle.parentNode.removeChild(handle);
			}
		} else {

			if( typeof ( name ) === "object" ) {

				var num = name.length;

				for( var i = 0; i < num; i++ ) {

					var handle = document.querySelector( name[i] );

					if( handle !== null ) {

						handle.parentNode.removeChild(handle);
					}
				}
			}
		}
		
	}

};

Element.new("div", {
	id : "main",
	url : "www.sawtbeirut.com",
	style : "width: 100px; height: 100px",
	onclick : "function()"

}).attach();

Element.remove(['.div1', '#div1', '.div2', '.div3']);
