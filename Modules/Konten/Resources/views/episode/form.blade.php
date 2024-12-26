<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Title" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.title"
                label="Title"
    			name="title"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* {{__('required')}}"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Link Video" rules="video">
            <v-file-input
                    class="my-4"
                    accept="video/*"
                    prepend-icon="mdi-video"
                    hint="Hanya menerima file video"
                    :persistent-hint="true"
                    clear-icon="mdi-eraser-variant"
                    show-size
                    chips
                    label="Video"
                    name="video"
            ></v-file-input>
            <v-row class="mb-3">
                <v-col
                        v-if="form_data.link_video"
                        cols="12"
                        md="3"
                >
                    <a :href="form_data.link_video" target="_blank">
                        <v-card
                                class="mx-auto"
                                min-height="150"
                                max-height="150"
                                max-width="250"
                                tile
                        >
                            <video
                                :src="form_data.link_video"
                                style="max-height: 150px; max-width: 250px"
                            ></video>
                        </v-card>
                    </a>
                </v-col>
            </v-row>
        </validation-provider>
{{--        <validation-provider rules="required" name="Link Video" v-slot="{ errors }">--}}
{{--            <v-text-field--}}
{{--                class="my-4"--}}
{{--                v-model="form_data.link_video"--}}
{{--                label="Link Video"--}}
{{--                name="link_video"--}}
{{--                clearable--}}
{{--                clear-icon="mdi-eraser-variant"--}}
{{--                hint="* {{__('required')}}"--}}
{{--                :persistent-hint="true"--}}
{{--                :error-messages="errors"--}}
{{--                :disabled="field_state"--}}
{{--            ></v-text-field>--}}
{{--        </validation-provider>--}}
      
        <v-btn
        	class="mr-4"
          	:loading="field_state"
          	:disabled="field_state"
            color="primary"
            @click="submitForm"
        >
            {{__('save')}}
            <template v-slot:loader>
                <span class="custom-loader">
                  	<v-icon light>mdi-cached</v-icon>
                </span>
            </template>
        </v-btn>
        <v-btn
	        type="button"
	        @click="clearForm"
	        :disabled="field_state"
	    >
            {{__('clear')}}
        </v-btn>
    </form>

    <v-snackbar
        v-model="form_alert_state"
        top
        multi-line
        :color="form_alert_color"
        elevation="5"
        timeout="6000"
    >
    	@{{ form_alert_text }}
    </v-snackbar>
</validation-observer>