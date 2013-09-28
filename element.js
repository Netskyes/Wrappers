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
		if( name && typeof ( name ) === "string" ) {
		
		var handle = document.querySelector( name );
		if( handle !== null ) {
			handle.appendChild(this.el);
		}

		} else {
			if( document.body !== null ) {
				document.body.appendChild(this.el);
			}
		} 
	}

};


// Example

Element.new("div", {
	id : "main",
	url : "www.sawtbeirut.com",
	style : "width: 100px; height: 100px"
	
}).attach();

