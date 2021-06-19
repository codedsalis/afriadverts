<template>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="">
      <div class="flex flex-col rounded-md shadow border border-gray-200">
        <div class="flex justify-between bg-gray-200">
          <div class="text-xl font-bold text-aa-dark py-2 px-3">
            <i class="fa fa-bullhorn text-purple-700"></i> Basic
          </div>
          <a v-if="advert.approved < 1"
            ><button
              @click="openModal('#basic')"
              class="text-link-100 font-bold hover:text-blue-500 border px-5 py-2 rounded-md hover:border-link-100 focus:outline-none"
            >
              <i class="fa fa-edit"></i> Edit
            </button></a
          >
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Objective</div>
          <div class="font-normal">
            {{ getAdvertTypeMessage(advert.advert_type) }}
          </div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Display format</div>
          <div class="font-normal">
            {{ advert.ad_format }}
            format
          </div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Status</div>
          <div class="font-bold">
            <span v-html="setAdvertStatus(advert.ad_status)"></span>
          </div>
        </div>
      </div>

      <br />

      <div class="flex flex-col rounded-md shadow border border-gray-200">
        <div class="bg-gray-200 flex justify-between text-aa-dark">
          <div class="text-xl font-bold text-aa-dark py-2 px-3">
            <i class="fa fa-sliders text-green-600"></i> Configuration
          </div>
          <a v-if="advert.approved < 1"
            ><button
              @click="openModal('#configuration')"
              class="text-link-100 font-bold hover:text-blue-500 border px-5 py-2 rounded-md hover:border-link-100 focus:outline-none"
            >
              <i class="fa fa-edit"></i> Edit
            </button></a
          >
        </div>

        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Advert name/title</div>
          <div class="font-normal">{{ advert.ad_title }}</div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Destination</div>
          <div class="font-normal text-green-600">{{ advert.ad_url }}</div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Headline</div>
          <div class="font-bold">{{ advert.sub_text }}</div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Action button</div>
          <div class="font-bold">{{ advert.action_button }}</div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Description</div>
          <div class="font-normal">{{ advert.ad_description }}</div>
        </div>
      </div>

      <br />

      <div class="flex flex-col rounded-md shadow border border-gray-200">
        <div class="bg-gray-200 flex justify-between text-aa-dark">
          <div class="bg-gray-200 text-xl font-bold text-aa-dark py-2 px-3">
            <i class="fa fa-bullseye text-red-700"></i> Targeting
          </div>
          <a v-if="advert.approved < 1"
            ><button
              @click="openModal('#targeting')"
              class="text-link-100 font-bold hover:text-blue-500 border px-5 py-2 rounded-md hover:border-link-100 focus:outline-none"
            >
              <i class="fa fa-edit"></i> Edit
            </button></a
          >
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Target countries</div>
          <div class="font-normal">{{ advert.target_countries }}</div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Target categories</div>
          <div class="font-normal">{{ advert.target_categories }}</div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Target keywords</div>
          <div class="font-normal">{{ advert.target_keywords }}</div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Target platform</div>
          <div class="font-normal">{{ advert.target_os }}</div>
        </div>
      </div>
    </div>
    <div class="">
      <div class="flex flex-col rounded-md shadow border-2 border-link-100">
        <div class="bg-gray-200 flex justify-between text-aa-dark">
          <div class="bg-gray-200 text-xl font-bold text-aa-dark py-2 px-3">
            <i class="fa fa-eye text-indigo-600"></i> Preview
          </div>
          <a v-if="advert.approved < 1"
            ><button
              @click="openModal('#advert-images')"
              class="text-link-100 font-bold hover:text-blue-500 border px-5 py-2 rounded-md hover:border-link-100 focus:outline-none"
            >
              <i class="fa fa-camera"></i> Change images
            </button></a
          >
        </div>
        <p class="px-2 py-1 text-aa-dark">
          This is how your advert will be displayed to your audiences
        </p>
        <advert-preview :advert="this.advert"></advert-preview>
      </div>
      <br />
      <div class="flex flex-col rounded-md shadow border border-gray-200">
        <div class="bg-gray-200 flex justify-between text-aa-dark">
          <div class="bg-gray-200 text-xl font-bold text-aa-dark py-2 px-3">
            <i class="fa fa-calendar text-pink-700"></i> Budget and duration
          </div>
          <a v-if="advert.approved < 1"
            ><button
              @click="openModal('#budget')"
              class="text-link-100 font-bold hover:text-blue-500 border px-5 py-2 rounded-md hover:border-link-100 focus:outline-none"
            >
              <i class="fa fa-edit"></i> Edit
            </button></a
          >
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Total budget</div>
          <div class="font-bold">
            <show-money
              v-if="!this.form.budget.modified"
              :user="this.user"
              :moneyInKobo="advert.ad_budget"
            ></show-money>
            <show-money
              v-else
              :useNaira="true"
              :user="this.user"
              :moneyInKobo="advert.ad_budget"
            ></show-money>
          </div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Daily budget</div>
          <div class="font-bold">
            <show-money
              v-if="!this.form.budget.modified"
              :user="this.user"
              :moneyInKobo="advert.daily_budget"
            ></show-money>
            <show-money
              v-else
              :useNaira="true"
              :user="this.user"
              :moneyInKobo="advert.daily_budget"
            ></show-money>
          </div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">Cost per click</div>
          <div class="font-bold">
            <show-money
              v-if="!this.form.budget.modified"
              :user="this.user"
              :moneyInKobo="advert.ad_cpc"
            ></show-money>
            <show-money
              v-else
              :useNaira="true"
              :user="this.user"
              :moneyInKobo="advert.ad_cpc"
            ></show-money>
          </div>
        </div>
        <div
          class="flex justify-between bg-white p-4 text-aa-dark border-b border-gray-200"
        >
          <div class="font-normal">When to stop publishing</div>
          <div class="font-normal">
            <show-date :dateVal="advert.duration"></show-date>
          </div>
        </div>
      </div>
      <br />
      <div class="flex justify-end">
        <a :href="'/a/adinfo/' + advert.id">
          <button
            class="text-link-100 font-bold hover:text-blue-500 border px-5 py-3 rounded-full hover:border-link-100 focus:outline-none mr-2"
          >
            <i class="fa fa-line-chart"></i> Statistics
          </button></a
        >
        <a
          v-if="advert.ad_status == 'running'"
          @click="pauseAndResumeAdvert(advert.id, 'pause')"
        >
          <button
            class="text-link-100 font-bold hover:text-blue-500 border px-5 py-3 rounded-full hover:border-link-100 focus:outline-none mr-2"
          >
            <i class="fa fa-pause"></i> Pause
          </button></a
        >
        <a
          v-if="advert.ad_status == 'paused'"
          @click="pauseAndResumeAdvert(advert.id, 'resume')"
          ><button
            class="text-link-100 font-bold hover:text-blue-500 border px-5 py-3 rounded-full hover:border-link-100 focus:outline-none mr-2"
          >
            <i class="fa fa-play"></i> Resume
          </button></a
        >
        <a @click="deleteAdvert(advert.id)">
          <button
            class="text-red-600 font-bold hover:text-red-700 border px-5 py-3 rounded-full hover:border-red-600 focus:outline-none"
          >
            <i class="fa fa-trash"></i> Delete
          </button></a
        >
      </div>
    </div>

    <!-- Modals for editing the advert setup -->
    <!-- Begin modal for Basic setup -->
    <div
      id="basic"
      class="main-modal hidden fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
      style="background: rgba(0, 0, 0, 0.7)"
    >
      <div
        class="border border-gray-500 shadow-lg modal-container bg-white w-11/12 md:w-2/5 mx-auto rounded-lg z-50 overflow-y-auto"
      >
        <div class="modal-content py-2 text-left px-6">
          <!--Title-->
          <div class="flex justify-between items-center pb-3">
            <p class="text-2xl font-bold text-aa-dark">Basic setup</p>
            <div class="modal-close cursor-pointer z-50">
              <button
                @click="closeModal('#basic')"
                class="p-3 text-3xl text-link-100 hover:text-link-300 focus:outline-none"
              >
                &times;
              </button>
            </div>
          </div>
          <!--Body-->
          <div class="my-5">
            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3">
              <div>
                <label for="objective">Advert Objective:</label>
                <select
                  id="objective"
                  v-model="form.basic.advert_type"
                  class="bg-white p-3 border-2 w-full border-gray-300 rounded-md focus:outline-none focus:border-link-100"
                >
                  <option :value="'website'">
                    Drive traffic to your website
                  </option>
                  <option :value="'phone'">Get phone call(s)</option>
                  <option :value="'whatsapp'">Get Whatsapp message(s)</option>
                </select>
              </div>
              <div>
                <label for="format">Display format:</label>
                <select
                  id="format"
                  v-model="form.basic.format"
                  class="bg-white p-3 border-2 w-full border-gray-300 rounded-md focus:outline-none focus:border-link-100"
                >
                  <option :value="'image'">Image ad format</option>
                  <option :value="'carousel'">Carousel ad format</option>
                  <option :value="'responsive'">Responsive ad format</option>
                </select>
              </div>
            </div>
            <br />
            <div class="flex justify-end">
              <button
                @click="saveBasicChanges()"
                v-bind:class="{
                  'cursor-not-allowed opacity-75 text-gray-300': formIsLoading,
                }"
                class="bg-light-500 text-white font-bold rounded-md px-5 py-3 hover:bg-light-600 focus:outline-none"
              >
                <div class="flex">
                  <div class="px-1">
                    <div v-bind:class="{ spinner: formIsLoading }"></div>
                  </div>
                  <div>Save changes</div>
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End modal for basic setup -->

    <!-- Begin modal for configuration setup -->
    <div
      id="configuration"
      class="main-modal hidden fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
      style="background: rgba(0, 0, 0, 0.7)"
    >
      <div
        class="border border-gray-500 shadow-lg modal-container bg-white w-11/12 md:w-2/5 mx-auto rounded-lg z-50 overflow-y-auto"
      >
        <div class="modal-content py-3 text-left px-6">
          <!--Title-->
          <div class="flex justify-between items-center pb-3">
            <p class="text-2xl font-bold text-aa-dark">Configuration</p>
            <div class="modal-close cursor-pointer z-50">
              <button
                @click="closeModal('#configuration')"
                class="p-3 text-3xl text-link-100 hover:text-link-300 focus:outline-none"
              >
                &times;
              </button>
            </div>
          </div>
          <!--Body-->
          <div class="my-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label for="title" class="text-aa-dark">Ad title/name</label>
                <input
                  type="text"
                  id="title"
                  v-model="form.configuration.title"
                  placeholder="Enter title/name"
                  class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
                  required
                />
                <span
                  class="text-red-600"
                  id="error-title"
                  v-for="error_title in this.form_error.title"
                  :key="error_title"
                  >{{ error_title }}</span
                >
              </div>
              <!-- Destination for website -->
              <div v-if="advert.advert_type == 'website'">
                <label for="url" class="text-aa-dark">Destination URL</label>
                <input
                  type="url"
                  id="url"
                  v-model="form.configuration.url"
                  placeholder="https://"
                  class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
                  required
                />
                <span
                  class="text-red-600"
                  id="error-url"
                  v-for="error_url in this.form_error.url"
                  :key="error_url"
                  >{{ error_url }}</span
                >
              </div>
              <!-- End of website -->
              <!-- Begin destination for whatsapp and phone -->
              <div
                v-if="
                  advert.advert_type == 'whatsapp' ||
                  advert.advert_type == 'phone'
                "
              >
                <label for="url" class="text-aa-dark">Telephone number</label>
                <input
                  type="text"
                  inputmode="numeric"
                  id="url"
                  v-model="form.url"
                  placeholder="+2348012345678"
                  class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
                  required
                />
                <span
                  class="text-red-600"
                  id="error-url"
                  v-for="error_url in this.form_error.url"
                  :key="error_url"
                  >{{ error_url }}</span
                >
              </div>
              <!-- end of whatsapp and phone -->
              <div>
                <label for="subtext" class="text-aa-dark">Headline</label>
                <input
                  type="text"
                  id="subtext"
                  v-model="form.configuration.subtext"
                  placeholder="Advertise with AfriAdverts"
                  class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
                  required
                />
                <span
                  class="text-red-600"
                  id="error-url"
                  v-for="error_subtext in this.form_error.subtext"
                  :key="error_subtext"
                  >{{ error_subtext }}</span
                >
              </div>
              <div>
                <label for="action_btn" class="text-aa-dark"
                  >Action button text</label
                >
                <select
                  id="action_btn"
                  v-model="form.configuration.action_btn"
                  class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
                  required
                  v-bind:class="{
                    'disabled=disabled':
                      advert.advert_type == 'whatsapp' ||
                      advert.advert_type == 'phone',
                  }"
                >
                  <option
                    v-if="advert.advert_type == 'website'"
                    :value="'Learn more'"
                  >
                    Learn more
                  </option>
                  <option
                    v-if="advert.advert_type == 'website'"
                    :value="'Download Now'"
                  >
                    Download Now
                  </option>
                  <option
                    v-if="advert.advert_type == 'website'"
                    :value="'Send email'"
                  >
                    Send email
                  </option>
                  <option
                    v-if="advert.advert_type == 'website'"
                    :value="'contact us'"
                  >
                    Contact Us
                  </option>
                  <option
                    v-if="advert.advert_type == 'website'"
                    :value="'book now'"
                  >
                    Book Now
                  </option>
                  <option
                    v-if="advert.advert_type == 'website'"
                    :value="'Sign Up'"
                  >
                    Sign Up
                  </option>
                  <option
                    v-if="advert.advert_type == 'website'"
                    :value="'play game'"
                  >
                    Play Game
                  </option>
                  <option
                    v-if="advert.advert_type == 'website'"
                    :value="'See offers'"
                  >
                    See Offers
                  </option>
                  <option
                    v-if="advert.advert_type == 'website'"
                    :value="'shop now'"
                  >
                    Shop Now
                  </option>
                  <option
                    v-if="advert.advert_type == 'phone'"
                    :value="'call now'"
                  >
                    Call Now
                  </option>
                  <option
                    v-if="advert.advert_type == 'whatsapp'"
                    :value="'send message'"
                  >
                    Send Message
                  </option>
                </select>
              </div>
            </div>
            <br />
            <label for="description" class="text-aa-dark">Ad description</label>
            <textarea
              id="description"
              v-model="form.configuration.description"
              class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
              placeholder="Description of your Ad"
              required
            ></textarea>
            <span class="text-aa-dark">
              Provide a short vivid description of your Ad as you would want
              others to see it <b>(Not more than 100 characters)</b>
            </span>
            <br />
            <span
              class="text-red-600"
              id="error-description"
              v-for="error_description in this.form_error.description"
              :key="error_description"
              >{{ error_description }}</span
            >
            <div
              id="info"
              class="bg-red-600 text-white p-5 rounded hidden w-full md:w-2/4 animate__animated animate__shakeX"
            >
              Please fill all fields to continue to the next step
            </div>
          </div>
          <div class="flex justify-end">
            <button
              @click="saveConfigurationChanges()"
              v-bind:class="{
                'cursor-not-allowed opacity-75 text-gray-300':
                  form.configuration.formIsLoading,
              }"
              class="bg-light-500 text-white font-bold rounded-md px-5 py-3 hover:bg-light-600 focus:outline-none"
            >
              <div class="flex">
                <div class="px-1">
                  <div
                    v-bind:class="{ spinner: form.configuration.formIsLoading }"
                  ></div>
                </div>
                <div>Save changes</div>
              </div>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- End modal for configuration setup -->

    <!-- Begin modal for targeting setup -->
    <div
      id="targeting"
      class="main-modal hidden fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
      style="background: rgba(0, 0, 0, 0.7)"
    >
      <div
        class="border border-gray-500 shadow-lg modal-container h-screen md:h-auto overflow-y-scroll bg-white w-11/12 md:w-2/5 mx-auto rounded-lg z-50 overflow-hidden"
      >
        <div class="modal-content py-3 text-left px-6">
          <!--Title-->
          <div class="flex justify-between items-center pb-3">
            <p class="text-2xl font-bold text-aa-dark">Targeting</p>
            <div class="modal-close cursor-pointer z-50">
              <button
                @click="closeModal('#targeting')"
                class="p-3 text-3xl text-link-100 hover:text-link-300 focus:outline-none"
              >
                &times;
              </button>
            </div>
          </div>
          <!--Body-->
          <div class="my-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="bg-gray-100 p-5 rounded">
                <label for="country" class="text-aa-dark font-bold"
                  >Target region:</label
                >
                <select
                  id="country"
                  v-model="form.targeting.country"
                  class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
                  multiple
                  required
                >
                  <option :value="'all'">All</option>
                  <option :value="'Nigeria'">Nigeria</option>
                  <option :value="'Ghana'">Ghana</option>
                  <option :value="'Kenya'">Kenya</option>
                  <option :value="'Rwanda '">Rwanda</option>
                  <option :value="'Uganda '">Uganda</option>
                  <option :value="'Côte dIvoire'">Côte d\'Ivoire</option>
                  <option :value="'Gambia '">Gambia</option>
                  <option :value="'Liberia'">Liberia</option>
                  <option :value="'Sierra Leone'">Sierra Leone</option>
                  <option :value="'Algeria'">Algeria</option>
                  <option :value="'Ethiopia'">Ethiopia</option>
                  <option :value="'Egypt'">Egypt</option>
                  <option :value="'south africa'">South Africa</option>
                  <option :value="'Tanzania'">Tanzania</option>
                  <option :value="'Sudan'">Sudan</option>
                  <option :value="'Benin'">Benin</option>
                  <option :value="'Tunisia'">Tunisia</option>
                  <option :value="'Senegal'">Senegal</option>
                  <option :value="'Zimbabwe'">Zimbabwe</option>
                  <option :value="'Madagascar'">Madagascar</option>
                </select>
                <span class="text-aa-dark">
                  Select which of these countries you would like your advert to
                  be diplayed to.
                  <b
                    >You may control-click (Windows) or command-click (Mac) to
                    select more than one</b
                  >
                </span>
                <br />
                <span
                  class="text-red-600"
                  id="error-country"
                  v-for="error_country in this.form_error.country"
                  :key="error_country"
                  >{{ error_country }}</span
                >
              </div>
              <div class="bg-gray-100 p-5 rounded">
                <label for="platform" class="text-aa-dark font-bold"
                  >Target platform(s):</label
                >
                <select
                  id="platform"
                  v-model="form.targeting.platform"
                  class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
                  multiple
                  required
                >
                  <option :value="'all'">All platforms</option>
                  <option :value="'android'">Android</option>
                  <option :value="'ios'">iOS</option>
                  <option :value="'windows'">Windows</option>
                  <option :value="'mac os'">Mac OS</option>
                  <option :value="'linux'">Linux</option>
                </select>
                <span class="text-aa-dark"
                  ><b
                    >You may control-click (Windows) or command-click (Mac) to
                    select more than one</b
                  ></span
                >
              </div>
              <div class="bg-gray-100 p-5 rounded">
                <label for="categories" class="text-aa-dark font-bold"
                  >Target website categories:</label
                >
                <span class="text-aa-dark"
                  >Choose from the website categories you would like your advert
                  to be displayed on.
                </span>
                <br />
                <select
                  id="categories"
                  v-model="form.targeting.categories"
                  class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
                  multiple
                  required
                >
                  <option :value="'ecommerce'">e-commerce</option>
                  <option :value="'business'">Business</option>
                  <option :value="'entertainment'">Entertainment</option>
                  <option :value="'portfolio'">Portfolio</option>
                  <option :value="'non-profit'">Non-profit</option>
                  <option :value="'personal'">Personal</option>
                  <option :value="'forum'">Forum</option>
                  <option :value="'profit'">Profit</option>
                  <option :value="'fashion and design'">
                    Fashion and Design
                  </option>
                  <option :value="'religion'">Religion</option>
                  <option :value="'education'">Education</option>
                  <option :value="'technology'">Technology</option>
                  <option :value="'health and fitness'">
                    Health and Fitness
                  </option>
                  <option :value="'other'">Other</option>
                  <option :value="'all'">All</option>
                </select>
                <span class="text-aa-dark"
                  ><b
                    >You may control-click (Windows) or command-click (Mac) to
                    select more than one</b
                  ></span
                >
              </div>
              <div class="bg-gray-100 p-5 rounded">
                <label for="keywords" class="text-aa-dark font-bold"
                  >Target Keywords:</label
                >
                <textarea
                  id="keywords"
                  v-model="form.targeting.keywords"
                  class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
                  placeholder="Enter keywords and separate with comma"
                  required
                ></textarea>
                <span class="text-aa-dark">
                  Write down the keywords that are related to your advert and
                  separate with comma (<b>clothes,trouser,shoe,etc</b>)
                </span>
                <br />
                <span
                  class="text-red-600"
                  id="error-keywords"
                  v-for="error_keywords in this.form_error.keywords"
                  :key="error_keywords"
                  >{{ error_keywords }}</span
                >
              </div>
            </div>
          </div>
          <div class="flex justify-end">
            <button
              @click="saveTargetingChanges()"
              v-bind:class="{
                'cursor-not-allowed opacity-75 text-gray-300':
                  form.targeting.formIsLoading,
              }"
              class="bg-light-500 text-white font-bold rounded-md px-5 py-3 hover:bg-light-600 focus:outline-none"
            >
              <div class="flex">
                <div class="px-1">
                  <div
                    v-bind:class="{ spinner: form.targeting.formIsLoading }"
                  ></div>
                </div>
                <div>Save changes</div>
              </div>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- End modal for targeting setup -->

    <!-- Begin modal for advert images setup -->
    <div
      id="advert-images"
      class="main-modal hidden fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
      style="background: rgba(0, 0, 0, 0.7)"
    >
      <div
        class="border border-gray-500 shadow-lg modal-container h-screen overflow-y-scroll bg-white w-11/12 md:w-2/5 mx-auto rounded-lg z-50"
      >
        <div class="modal-content py-3 text-left px-6">
          <!--Title-->
          <div class="flex justify-between items-center pb-3">
            <p class="text-2xl font-bold text-aa-dark">
              Advert images(banners)
            </p>
            <div class="modal-close cursor-pointer z-50">
              <button
                @click="closeModal('#advert-images')"
                class="p-3 text-3xl text-link-100 hover:text-link-300 focus:outline-none"
              >
                &times;
              </button>
            </div>
          </div>
          <!--Body-->
          <div class="my-5">
            <b class="font-bold text-dark-500">Current images</b><br />
            <div
              class="grid grid-cols-2 md:grid-cols-5 gap-2 w-full"
              v-html="getAdvertImages()"
            ></div>
            <br />
            <b class="text-dark-500"
              >Select new images to upload if you want to change your advert
              images</b
            ><br /><br />
            <div class="flex justify-center">
              <label
                class="flex flex-col justify-center text-2xl bg-gray-400 border-2 border-gray-500 px-20 md:px-32 py-12 font-bold rounded shadow-md text-gray-600 hover:bg-dark-100"
                ><i class="fa fa-camera fa-3x text-gray-600 p-5 ml-3"></i>
                <span class="ml-4">Add files</span>
                <input
                  type="file"
                  id="files"
                  ref="files"
                  accept="image/*"
                  multiple
                  v-on:change="handleFilesUpload()"
                />
              </label>
            </div>
            <br />
            <span class="text-aa-dark text-xl"
              >You can upload a maximum of <b>5 banners</b>, use control-click
              to select more than 1 file on <b>Windows</b> or command-click on
              <b>Mac</b></span
            ><br />
            <span
              class="text-red-600"
              id="error-files"
              v-for="error_files in this.form_error.files"
              :key="error_files"
              >{{ error_files }}</span
            >
            <br /><br />
            <div v-if="files.length > 0">
              <b class="text-xl text-aa-dark font-bold">Selected files</b>
              <button
                class="bg-red-600 text-white px-10 py-2 rounded-md float-right hover:bg-red-900 shadow focus:outline-none"
                @click="clearFiles()"
              >
                <i class="fa fa-close"></i> Clear
              </button>
            </div>
            <br />
            <br />
            <div
              v-if="files.length > 0"
              class="bg-gray-200 rounded p-3 grid cols-1 md:grid-cols-2 lg:grid-cols-5 border border-gray-300"
            >
              <div v-for="(file, key) in files" :key="key" class="rounded">
                <img class="preview" v-bind:ref="'image' + parseInt(key)" />
              </div>
            </div>
            <br /><br />
            <span
              class="bg-red-600 text-white rounded p-5 w-full md:w-1/2 hidden animate__animated animate__shakeX"
              id="error-all"
              >Your submitted data contains error(s), navigate through the form
              to correct them</span
            >
          </div>
          <div class="flex justify-end">
            <button
              @click="saveImagesChanges()"
              v-bind:class="{
                'cursor-not-allowed opacity-75 text-gray-300':
                  form.images.formIsLoading,
              }"
              class="bg-light-500 text-white font-bold rounded-md px-5 py-3 hover:bg-light-600 focus:outline-none"
            >
              <div class="flex">
                <div class="px-1">
                  <div
                    v-bind:class="{ spinner: form.images.formIsLoading }"
                  ></div>
                </div>
                <div>Save changes</div>
              </div>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- End modal for advert images setup -->

    <!-- Begin modal for budget setup -->
    <div
      id="budget"
      class="main-modal hidden fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
      style="background: rgba(0, 0, 0, 0.7)"
    >
      <div
        class="border border-gray-500 shadow-lg modal-container h-screen md:h-auto overflow-y-scroll bg-white w-11/12 md:w-2/5 mx-auto rounded-lg z-50"
      >
        <div class="modal-content py-3 text-left px-6">
          <!--Title-->
          <div class="flex justify-between items-center pb-3">
            <p class="text-2xl font-bold text-aa-dark">Budget and duration</p>
            <div class="modal-close cursor-pointer z-50">
              <button
                @click="closeModal('#budget')"
                class="p-3 text-3xl text-link-100 hover:text-link-300 focus:outline-none"
              >
                &times;
              </button>
            </div>
          </div>
          <!--Body-->
          <div class="my-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="bg-gray-100 border border-gray-100 p-3 rounded">
                <label for="country" class="text-aa-dark font-bold"
                  >Daily budget:</label
                >
                (<span class="text-aa-light"
                  >How much are you willing to spend daily for this ad?</span
                >)
                <br />
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.daily_budget"
                    value="100"
                    id="daily-100"
                  /><label for="daily-100"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="100"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.daily_budget"
                    value="200"
                    id="daily-200"
                  /><label for="daily-200"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="200"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.daily_budget"
                    value="400"
                    id="daily-400"
                  /><label for="daily-400"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="400"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.daily_budget"
                    value="600"
                    id="daily-600"
                  /><label for="daily-600"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="600"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.daily_budget"
                    value="1000"
                    id="daily-1000"
                  /><label for="daily-1000"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="1000"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 font-bold text-link-400">
                  <input type="radio" value="manual" id="daily-manual" /><label
                    for="daily-manual"
                    @click="showManualEntry('daily_budget')"
                    >&#160;&#160;Manual entry</label
                  >
                  <input
                    type="text"
                    id="daily-manual-entry"
                    v-model="form.budget.daily_budget"
                    placeholder="Enter your daily budget"
                    class="p-3 hidden border-2 w-full border-gray-300 bg-white rounded-md focus:outline-none focus:border-link-100"
                    required
                  />
                  <span
                    class="text-red-600"
                    id="error-daily"
                    v-for="error_daily_budget in this.form_error.daily_budget"
                    :key="error_daily_budget"
                    >{{ error_daily_budget }}</span
                  >
                </div>
              </div>
              <div class="bg-gray-100 border border-gray-100 p-3 rounded">
                <label for="country" class="text-aa-dark font-bold"
                  >Total budget:</label
                >
                (<span class="text-aa-light"
                  >How much in total do you want to spend on this ad?</span
                >)
                <br />
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.total_budget"
                    value="500"
                    id="total-500"
                  /><label for="total-500"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="500"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.total_budget"
                    value="1000"
                    id="total-1000"
                  /><label for="total-1000"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="1000"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.total_budget"
                    value="1500"
                    id="total-1500"
                  /><label for="total-1500"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="1500"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.total_budget"
                    value="2000"
                    id="total-2000"
                  /><label for="total-2000"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="2000"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.total_budget"
                    value="5000"
                    id="total-5000"
                  /><label for="total-5000"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="5000"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 font-bold text-link-400">
                  <input type="radio" value="manual" id="total-manual" /><label
                    for="total-manual"
                    @click="showManualEntry('total_budget')"
                    >&#160;&#160;Manual entry</label
                  >
                  <input
                    type="text"
                    id="total-manual-entry"
                    v-model="form.budget.total_budget"
                    placeholder="Enter your total budget"
                    class="p-3 hidden border-2 w-full border-gray-300 bg-white rounded-md focus:outline-none focus:border-link-100"
                    required
                  />
                  <span
                    class="text-red-600"
                    id="error-total"
                    v-for="error_total in this.form_error.total"
                    :key="error_total"
                    >{{ error_total }}</span
                  >
                </div>
              </div>
              <div class="bg-gray-100 border border-gray-100 p-3 rounded">
                <label for="country" class="text-aa-dark font-bold"
                  >Cost per click:</label
                >
                (<span class="text-aa-light"
                  >How much are you willing to pay for each user that clicks the
                  ad?</span
                >)
                <br />
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.cpc"
                    value="10"
                    id="cpc-10"
                  /><label for="cpc-10"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="10"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.cpc"
                    value="15"
                    id="cpc-15"
                  /><label for="cpc-15"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="15"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.cpc"
                    value="20"
                    id="cpc-20"
                  /><label for="cpc-20"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="20"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.cpc"
                    value="25"
                    id="cpc-25"
                  /><label for="cpc-25"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="25"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 text-xl">
                  <input
                    type="radio"
                    v-model="form.budget.cpc"
                    value="50"
                    id="cpc-50"
                  /><label for="cpc-50"
                    >&#160;&#160;<show-money
                      :useNaira="true"
                      :moneyInKobo="50"
                      :user="this.user"
                    ></show-money
                  ></label>
                </div>
                <div class="py-1 font-bold text-link-400">
                  <input type="radio" value="manual" id="cpc-manual" /><label
                    for="cpc-manual"
                    @click="showManualEntry('cpc')"
                    >&#160;&#160;Manual entry</label
                  >
                  <input
                    type="text"
                    id="cpc-manual-entry"
                    v-model="form.budget.cpc"
                    placeholder="Enter your cost per click rate"
                    class="p-3 hidden border-2 w-full border-gray-300 bg-white rounded-md focus:outline-none focus:border-link-100"
                    required
                  />
                  <span
                    class="text-red-600"
                    id="error-cpc"
                    v-for="error_cpc in this.form_error.cpc"
                    :key="error_cpc"
                    >{{ error_cpc }}</span
                  >
                </div>
              </div>
              <div class="bg-gray-100 border border-gray-100 p-3 rounded">
                <label for="duration" class="text-aa-dark font-bold"
                  >Duration:</label
                >
                (<span class="text-aa-light"
                  >How long do you want to run this ad? Choose a date when it
                  should be stopped</span
                >)
                <br />
                <input
                  type="date"
                  class="p-4 border-2 border-gray-300 rounded focus:outline-none focus:border-link-100"
                  v-model="form.budget.duration"
                />
                <span
                  class="text-red-600"
                  id="error-duration"
                  v-for="error_duration in this.form_error.duration"
                  :key="error_duration"
                  >{{ error_duration }}</span
                >
              </div>
            </div>
          </div>
          <div class="flex justify-end">
            <button
              @click="saveBudgetChanges()"
              v-bind:class="{
                'cursor-not-allowed opacity-75 text-gray-300':
                  form.budget.formIsLoading,
              }"
              class="bg-light-500 text-white font-bold rounded-md px-5 py-3 hover:bg-light-600 focus:outline-none"
            >
              <div class="flex">
                <div class="px-1">
                  <div
                    v-bind:class="{ spinner: form.budget.formIsLoading }"
                  ></div>
                </div>
                <div>Save changes</div>
              </div>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- End modal for budget setup -->
  </div>
</template>

<script>
import axios from "axios";
import ShowMoney from "../ShowMoney.vue";
import ShowDate from "../ShowDate.vue";
import AdvertPreview from "./AdvertPreview.vue";
import EditBasic from "./editads/EditBasic.vue";
import VueNoty from "vuejs-noty";
import "vuejs-noty/dist/vuejs-noty.css";
export default {
  props: ["user", "advert"],
  components: {
    ShowMoney,
    ShowDate,
    AdvertPreview,
    EditBasic,
  },
  data() {
    return {
      formIsLoading: false,
      form_error: {},
      form: {
        basic: {
          format: this.advert.ad_format,
          advert_type: this.advert.advert_type,
          formIsLoading: false,
        },
        configuration: {
          title: this.advert.ad_title,
          url: this.advert.ad_url,
          subtext: this.advert.sub_text,
          action_btn: this.advert.action_button,
          description: this.advert.ad_description,
          formIsLoading: false,
        },
        targeting: {
          country: [],
          keywords: this.advert.target_keywords,
          platform: [],
          categories: [],
          formIsLoading: false,
        },
        budget: {
          total_budget: this.toNaira(this.advert.ad_budget),
          daily_budget: this.toNaira(this.advert.daily_budget),
          cpc: this.toNaira(this.advert.ad_cpc),
          duration: this.advert.duration,
          modified: false,
          formIsLoading: false,
        },
        images: {
          formIsLoading: false,
        },
      },
      files: [],
    };
  },
  methods: {
    getAdvertTypeMessage(advertType) {
      if (advertType == "website") {
        return "Drive traffic to your website";
      } else if (advertType == "phone") {
        return "Get phone call(s)";
      } else if (advertType == "whatsapp") {
        return "Get Whatsapp message(s)";
      }
    },
    getAdvertImages() {
      let images = this.advert.ad_images.split(",");
      var hh = "";
      for (let i = 0; i < images.length - 1; i++) {
        hh +=
          '<div><img src="' +
          this.$root.$data.banners +
          "/" +
          this.advert.advert_token.substring(0, 25) +
          "/" +
          images[i] +
          '"/></div>';
      }
      return hh;
    },
    setAdvertStatus(status) {
      if (status == "pending approval") {
        return '<span class="text-yellow-700">Pending approval</span>';
      } else if (status == "running") {
        return '<span class="text-green-600">Active</span>';
      } else if (status == "stopped") {
        return '<span class="text-red-600">Stopped</span>';
      } else if (status == "paused") {
        return '<span class="text-gray-700">Paused</span>';
      } else if (status == "disapproved") {
        return '<span class="text-red-700">Disapproved</span>';
      }
    },
    closeModal(modalId) {
      let modal = document.querySelector(modalId);
      //   let closeButton = document.querySelectorAll(".modal-close");
      modal.classList.remove("fadeIn");
      modal.classList.add("fadeOut");
      setTimeout(() => {
        modal.style.display = "none";
      }, 500);
    },
    openModal(modalId) {
      let modal = document.querySelector(modalId);
      //   let closeButton = document.querySelectorAll(".modal-close");
      modal.classList.remove("fadeOut");
      modal.classList.add("fadeIn");
      modal.style.display = "flex";
    },
    toNaira(amountInKobo) {
      return parseInt(amountInKobo / 100);
    },
    toKobo(amount) {
      return amount * 100;
    },
    clearFiles() {
      this.files = [];
    },
    showManualEntry(budget) {
      switch (budget) {
        case "daily_budget":
          this.form.budget.daily_budget = 0;
          document.querySelector("#daily-manual-entry").style.display = "block";
          break;
        case "total_budget":
          this.form.budget.total_budget = 0;
          document.querySelector("#total-manual-entry").style.display = "block";
          break;
        case "cpc":
          this.form.budget.cpc = 0;
          document.querySelector("#cpc-manual-entry").style.display = "block";
          break;
        default:
          break;
      }
    },
    /*
        Handles the uploading of files
      */
    handleFilesUpload() {
      /*
          Get the uploaded files from the input.
        */
      let uploadedFiles = this.$refs.files.files;

      /*
          Adds the uploaded file to the files array
        */
      for (var i = 0; i < uploadedFiles.length; i++) {
        this.files.push(uploadedFiles[i]);
      }

      /*
          Generate image previews for the uploaded files
        */
      this.getImagePreviews();
    },

    /*
        Gets the preview image for the file.
      */
    getImagePreviews() {
      /*
          Iterate over all of the files and generate an image preview for each one.
        */
      for (let i = 0; i < this.files.length; i++) {
        /*
            Ensure the file is an image file
          */
        if (/\.(jpe?g|png|gif)$/i.test(this.files[i].name)) {
          /*
              Create a new FileReader object
            */
          let reader = new FileReader();

          /*
              Add an event listener for when the file has been loaded
              to update the src on the file preview.
            */
          reader.addEventListener(
            "load",
            function () {
              this.$refs["image" + parseInt(i)][0].src = reader.result;
            }.bind(this),
            false
          );

          /*
              Read the data for the file in through the reader. When it has
              been loaded, we listen to the event propagated and set the image
              src to what was loaded from the reader.
            */
          reader.readAsDataURL(this.files[i]);
        }
      }
    },
    saveBasicChanges() {
      this.formIsLoading = true;
      axios
        .put(`${this.$root.$data.api}/adverts`, {
          user_id: this.user.id,
          advert_id: this.advert.id,
          portion: "basic",
          advert_intent: this.form.basic.advert_type,
          format: this.form.basic.format,
        })
        .then((response) => {
          this.formIsLoading = false;
          this.advert.advert_type = this.form.basic.advert_type;
          this.advert.ad_format = this.form.basic.format;
          this.$noty.success("Changes saved", {
            layout: "topRight",
            theme: "metroui",
          });
          this.closeModal("#basic");
        })
        .catch((error) => {
          this.formIsLoading = false;
          console.log(error.response);
        });
    },
    saveConfigurationChanges() {
      this.form.configuration.formIsLoading = true;
      axios
        .put(`${this.$root.$data.api}/adverts`, {
          user_id: this.user.id,
          advert_id: this.advert.id,
          portion: "configuration",
          title: this.form.configuration.title,
          url: this.form.configuration.url,
          subtext: this.form.configuration.subtext,
          action_btn: this.form.configuration.action_btn,
          description: this.form.configuration.description,
        })
        .then((response) => {
          this.form.configuration.formIsLoading = false;
          this.advert.ad_title = this.form.configuration.title;
          this.advert.ad_url = this.form.configuration.url;
          this.advert.sub_text = this.form.configuration.subtext;
          this.advert.action_button = this.form.configuration.action_btn;
          this.advert.ad_description = this.form.configuration.description;
          this.$noty.success("Changes saved", {
            layout: "topRight",
            theme: "metroui",
          });
          this.closeModal("#configuration");
        })
        .catch((error) => {
          this.form.configuration.formIsLoading = false;
          console.log(error.response);
        });
    },
    saveTargetingChanges() {
      this.form.targeting.formIsLoading = true;
      axios
        .put(`${this.$root.$data.api}/adverts`, {
          user_id: this.user.id,
          advert_id: this.advert.id,
          portion: "targeting",
          country: this.form.targeting.country,
          keywords: this.form.targeting.keywords,
          platforms: this.form.targeting.platform,
          categories: this.form.targeting.categories,
        })
        .then((response) => {
          this.form.targeting.formIsLoading = false;
          this.advert.target_countries = this.form.targeting.country.toString();
          this.advert.target_keywords = this.form.targeting.keywords;
          this.advert.target_os = this.form.targeting.platform.toString();
          this.advert.target_categories = this.form.targeting.categories.toString();
          this.$noty.success("Changes saved", {
            layout: "topRight",
            theme: "metroui",
          });
          this.closeModal("#targeting");
        })
        .catch((error) => {
          this.form.targeting.formIsLoading = false;
          console.log(error.response);
        });
    },
    saveBudgetChanges() {
      this.form.budget.formIsLoading = true;
      axios
        .put(`${this.$root.$data.api}/adverts`, {
          user_id: this.user.id,
          advert_id: this.advert.id,
          portion: "budget",
          total_budget: this.form.budget.total_budget,
          daily_budget: this.form.budget.daily_budget,
          cpc: this.form.budget.cpc,
          duration: this.form.budget.duration,
        })
        .then((response) => {
          this.form.budget.formIsLoading = false;
          this.form.budget.modified = true;
          this.advert.ad_budget = this.form.budget.total_budget;
          this.advert.daily_budget = this.form.budget.daily_budget;
          this.advert.ad_cpc = this.form.budget.cpc;
          this.advert.duration = this.form.budget.duration;
          this.$noty.success("Changes saved", {
            layout: "topRight",
            theme: "metroui",
          });
          this.closeModal("#budget");
        })
        .catch((error) => {
          this.form.budget.formIsLoading = false;
          console.log(error.response);
        });
    },
    saveImagesChanges() {
      this.form.images.formIsLoading = true;

      let formData = new FormData();

      for (var i = 0; i < this.files.length; i++) {
        let file = this.files[i];
        formData.append("files[" + i + "]", file);
      }

      let images = "images";

      formData.append("user_id", this.user.id);
      formData.append("advert_id", this.advert.id);

      axios
        .post(`${this.$root.$data.api}/adverts`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.form.images.formIsLoading = false;
          this.$noty.success("images updated", {
            layout: "topRight",
            theme: "metroui",
          });
          setTimeout(() => {
            window.location.reload(true);
          }, 2000);
        })
        .catch((error) => {
          this.form.images.formIsLoading = false;
          console.log(error.response);
          // error.response.data.indexOf("files")
          //   ? (this.form_error.files = error.response.data[0].files)
          //   : null;
        });
    },
    pauseAndResumeAdvert(advertId, action) {
      if (action == "resume") {
        if (
          confirm(
            "You are about to resume displaying this advert, please confirm"
          )
        ) {
          axios
            .put(`${this.$root.$data.api}/adverts/action`, {
              advert_id: this.advert.id,
              user_id: this.user.id,
              action: "resume",
            })
            .then((response) => {
              this.$noty.success("Changes saved", {
                layout: "topRight",
                theme: "metroui",
              });
              this.advert.ad_status = "running";
              setTimeout(() => {
                window.location.reload();
              }, 300);
            })
            .catch((error) => {
              console.log(error.response);
            });
        }
      } else if (action == "pause") {
        if (
          confirm(
            "Are you sure you want to pause this advert? This action will stop it from being displayed"
          )
        ) {
          axios
            .put(`${this.$root.$data.api}/adverts/action`, {
              advert_id: this.advert.id,
              user_id: this.user.id,
              action: "pause",
            })
            .then((response) => {
              this.$noty.success("Changes saved", {
                layout: "topRight",
                theme: "metroui",
              });
              this.advert.ad_status = "paused";
              setTimeout(() => {
                window.location.reload();
              }, 300);
            })
            .catch((error) => {
              console.log(error.response);
            });
        }
      }
    },
    deleteAdvert(advertId) {
      if (
        confirm(
          "Are you sure you want to delete this advert? This action cannot be reversed"
        )
      ) {
        axios
          .delete(`${this.$root.$data.api}/adverts`, {
            data: {
              advert_id: this.advert.id,
              user_id: this.user.id,
            },
          })
          .then((response) => {
            this.$noty.success("Successfully deleted", {
              layout: "topRight",
              theme: "metroui",
            });
            setTimeout(() => {
              window.location.replace("/a/adverts");
            }, 300);
          })
          .catch((error) => {
            console.log(error.response);
          });
      }
    },
  },
};
</script>
<style scoped>
.animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

.animated.faster {
  -webkit-animation-duration: 500ms;
  animation-duration: 500ms;
}

.fadeIn {
  -webkit-animation-name: fadeIn;
  animation-name: fadeIn;
}

.fadeOut {
  -webkit-animation-name: fadeOut;
  animation-name: fadeOut;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}

@keyframes fadeOut {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
  }
}
input[type="file"] {
  position: absolute;
  top: -500px;
}
div.file-listing img {
  max-width: 90%;
}
</style>