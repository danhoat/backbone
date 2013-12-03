
	var BB = BB || {};

	BB.Models        = BB.Models || {};
	BB.Collections   = BB.Collections || {};
	BB.Views         = BB.Views || {};
	BB.Routers       = BB.Routers || {};

	
(function($){
	
	BB.Views.ItemPost = Backbone.Model.extend({
		defaults: {
			name: 'Guest User',
			age: 30,
			occupation: 'worker'
		}
	});

// The View for a BB.Views.ItemPost
	BB.Views.ItemPostView = Backbone.View.extend({
		tagName: 'li',


		//template: _.template($('#BB.Views.ItemPostTemplate').html() ),
		template: _.template('<div class="item"> <a href="<%= permalink %>"><%= post_title %> </a></div>' ),
		
		render: function() {
			this.$el.html( this.template(this.model.toJSON()) );
			return this;
		}
	});

	BB.Collections.View = Backbone.Collections.extend({
		
	});
	BB.Views.App = Backbone.View.extend({
		el : 'body',
		events : {
			'click a.edit' 	: 'editPost',
			'click a.del' 	: 'delPost' ,
			'submit form.insert-post' : 'addPost'
		},
		initialize : function(){
			console.log('da vao');
			this.container = this.$el.find('ul#list-posts');
		},

		editPost : function(event){

		},

		delPost : function(event){
			console.log('del');
		},
		addPost : function (event){
			event.preventDefault();
			var view 	= this;
			var element = $(event.currentTarget);
		
			var patch = $('form.insert-post').serialize();

			
			console.log('da them post');
			$.ajax({
				type :'get',
				url: bb_global.ajaxURL+ '?' + patch,				
				data :{
					action : 'bb-add-post', 
				
				},
				beforeSend :function(){

				},
				success : function(resp){
					if(resp.success) {
						var item 	= new BB.Views.ItemPostView({
							model 	: new BB.Views.ItemPost( resp.data )
						});
						view.container.append( item.render().$el );
					}
						
				}
			});
			return false;
		}
	});

	$(document).ready(function(){
		new BB.Views.App();
	});





})(jQuery);
