<script type="text/javascript">
	import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate';
	import { required, numeric } from 'vee-validate/dist/rules'
	import id from 'vee-validate/dist/locale/id.json'

	extend('required', required)
	extend('numeric', numeric)
    localize('id', id);

	export default {
		components: {
		    ValidationObserver,
		    ValidationProvider
		},
		props: {
			actionForm: {
				type: String,
				required: true
			},
			redirectUri: {
				type: String,
				required: true
			},
			dataUri: {
				type: String,
				default: ''
			},
		},
		data: () => ({
			enabled: false,
			periode_awal: false,
			periode_akhir: false,
      embed: {
        is_active: false,
        embed_link: ''
      },
			form_data: {
				anime_id: '',
				title: '',
				video: '',
				link_video: '',
        embeds: []
			},
			field_state: false,
			form_alert_state: false,
			form_alert_color: '',
			form_alert_text: ''
		}),
		mounted() {
        this.getFormData();
    },
		methods: {
    		getFormData() {
    			if (this.dataUri) {
    				this.field_state = true
    		        axios
    		            .get(this.dataUri)
    		            .then(response => {
    		            	if (response.data.success) {
    		            		let data = response.data.data
    		            		this.form_data = {
    		            			anime_id: data.anime_id,
    		            			title: data.title,
    		            			video: data.video,
    		            			link_video: data.link_video,
                          embeds: data.embeds ? [...data.embeds.map(function (item) {
                            return {...item, is_active: item.is_active === 'true'}
                          })] : []
    		            		}
                        this.field_state = false
    		            	} else {
    		            		this.form_alert_state = true
		    		            this.form_alert_color = 'error'
		    		            this.form_alert_text = response.data.message
			    		        this.field_state = false
    		            	}
    		            })
    		            .catch(error => {
		            		this.form_alert_state = true
	    		            this.form_alert_color = 'error'
	    		            this.form_alert_text = response.data.message
		    		        this.field_state = false
    		            });
    			}
    		},
      addServer() {
          this.form_data.embeds.push({...this.embed})
      },
			clearForm() {
				this.form_data = {
					title: '',
					video: '',
					link_video: '',
          embeds: []
				}
				this.$refs.observer.reset()
			},
      submitForm() {
        this.$refs.observer.validate().then((success) => {
          if (!success) {
              return;
          }
          this.field_state = true
          this.postFormData()
        });
      },
      postFormData() {
        const form_data = new FormData(this.$refs['post-form']);
        if (this.form_data.embeds && this.form_data.embeds.length) {
          this.form_data.embeds.forEach((item, index) => {
            form_data.append(`embeds[${index}][embed_link]`, item.embed_link);
            form_data.append(`embeds[${index}][is_active]`, item.is_active);
          })
        }
        if (this.dataUri) {
            form_data.append("_method", "put");
        }
        axios.post(this.actionForm, form_data)
            .then((response) => {
                if (response.data.success) {
                    this.form_alert_state = true
                    this.form_alert_color = 'success'
                    this.form_alert_text = response.data.message

                    this.goto(this.redirectUri);
                } else {
                  this.field_state = false

                    this.form_alert_state = true
                    this.form_alert_color = 'error'
                    this.form_alert_text = response.data.message
                }
            })
            .catch((error) => {
                this.field_state = false
                this.form_alert_state = true
                this.form_alert_color = 'error'
                    this.form_alert_text = 'Oops, something went wrong. Please try again later.'
            });
      }
		}
	}
</script>