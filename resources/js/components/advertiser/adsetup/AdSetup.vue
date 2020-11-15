<template>
  <div class="vld-parent">
    <loading
      :active.sync="isLoading"
      :can-cancel="false"
      :is-full-page="fullPage"
    ></loading>
    <h2 class="text-2xl font-bold text-aa-dark font-roboto">
      <i class="fa fa-hand-o-right"></i> Objective:
      <span class="text-aa-dark">{{ this.form.objectiveMsg }}</span>
    </h2>
    <br />
    <div v-if="step == 1">
      <br />
      <!-- Begin breadcrumbs for step 1 -->
      <div class="breadcrumb-wrapper">
        <div class="breadcrumb">
          <a class="active">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Ad format</span>
              <span class="breadcrumb__desc">Choose ad format</span>
            </span>
          </a>
          <a href="#">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Configuration</span>
              <span class="breadcrumb__desc">Configure the ad essentials</span>
            </span>
          </a>
          <a href="#">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Targeting</span>
              <span class="breadcrumb__desc"
                >set target platforms, keywords...</span
              >
            </span>
          </a>
          <a href="#">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">budget</span>
              <span class="breadcrumb__desc"
                >Set your budget and advert duration</span
              >
            </span>
          </a>
          <a href="#">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Upload banner(s)</span>
            </span>
          </a>
        </div>
      </div>
      <!-- End breadcrumbs for step 1 -->
      <br />
      <div class="font-bold text-2xl text-aa-dark px-3">
        <i class="fa fa-users"></i> Display format
      </div>
      <div class="text-aa-dark py-1">
        How do you want your advert to be displayed to your audience?
      </div>
      <br />
      <div class="flex flex-col md:flex-row rounded">
        <div
          @click="nextStep('image')"
          v-bind:class="{
            'border-2 border-green-500 bg-green-300': form.format == 'image',
          }"
          class="max-w-sm bg-white hover:bg-gray-300 rounded overflow-hidden shadow"
        >
          <img
            class="w-11/12"
            :src="this.$root.$data.assets + '/' + this.form.imageOne"
            width="250"
            height="250"
          />
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Image Ad format</div>
            <p class="text-gray-700 text-base">
              This ad format displays just a single image
            </p>
          </div>
        </div>
        <div
          @click="nextStep('carousel')"
          v-bind:class="{
            'border-2 border-green-500 bg-green-300': form.format == 'carousel',
          }"
          class="max-w-sm bg-white hover:bg-gray-300 rounded overflow-hidden shadow"
        >
          <img
            class="w-11/12"
            :src="this.$root.$data.assets + '/' + this.form.imageTwo"
            width="250"
            height="250"
          />
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Carousel Ad format</div>
            <p class="text-gray-700 text-base">
              This ad format displays several images in turns
            </p>
          </div>
        </div>
        <div
          @click="nextStep('responsive')"
          v-bind:class="{
            'border-2 border-green-500 bg-green-300':
              form.format == 'responsive',
          }"
          class="max-w-sm bg-white hover:bg-gray-300 rounded overflow-hidden shadow"
        >
          <img
            class="w-11/12"
            :src="this.$root.$data.assets + '/' + this.form.imageThree"
            width="250"
            height="250"
          />
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Responsive Ad format</div>
            <p class="text-gray-700 text-base">
              This ad format contains an image, text, action buttons
            </p>
          </div>
        </div>
        <span
          class="text-red-600"
          id="error-format"
          v-for="error_format in this.form_error.format"
          :key="error_format"
          >{{ error_format }}</span
        >
      </div>
    </div>
    <!-- End of step 1 -->
    <!-- Begin step 2 -->
    <div v-if="step == 2">
      <br />
      <!-- Begin bresdcrumb for step 2 -->
      <div class="breadcrumb-wrapper">
        <div class="breadcrumb">
          <a @click="previousStep()">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Ad format</span>
              <span class="breadcrumb__desc">Choose ad format</span>
            </span>
          </a>
          <a href="#" class="active">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Configuration</span>
              <span class="breadcrumb__desc">Configure the ad essentials</span>
            </span>
          </a>
          <a href="#">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Targeting</span>
              <span class="breadcrumb__desc"
                >set target platforms, keywords...</span
              >
            </span>
          </a>
          <a href="#">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">budget</span>
              <span class="breadcrumb__desc"
                >Set your budget and advert duration</span
              >
            </span>
          </a>
          <a href="#">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Upload banner(s)</span>
            </span>
          </a>
        </div>
      </div>
      <!-- End of breadcrumb for step 2 -->
      <br />

      <div class="font-bold text-2xl text-aa-dark p-3">
        <i class="fa fa-sliders"></i> Advert Configuration
      </div>
      <div
        class="container px-4 py-5 md:px-10 w-full bg-white rounded-lg shadow"
      >
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="title" class="text-aa-dark">Ad title/name</label>
            <input
              type="text"
              id="title"
              v-model="form.title"
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
          <div v-if="intent == 'website'">
            <label for="url" class="text-aa-dark">Destination URL</label>
            <input
              type="url"
              id="url"
              v-model="form.url"
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
          <div v-if="intent == 'whatsapp' || intent == 'phone'">
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
            <label for="subtext" class="text-aa-dark">Sub text</label>
            <input
              type="text"
              id="subtext"
              v-model="form.subtext"
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
              v-model="form.action_btn"
              class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
              required
              v-bind:class="{
                'disabled=disabled': intent == 'whatsapp' || intent == 'phone',
              }"
            >
              <option v-if="intent == 'website'" :value="'Learn more'">
                Learn more
              </option>
              <option v-if="intent == 'website'" :value="'Download Now'">
                Download Now
              </option>
              <option v-if="intent == 'website'" :value="'Send email'">
                Send email
              </option>
              <option v-if="intent == 'website'" :value="'contact us'">
                Contact Us
              </option>
              <option v-if="intent == 'website'" :value="'book now'">
                Book Now
              </option>
              <option v-if="intent == 'website'" :value="'Sign Up'">
                Sign Up
              </option>
              <option v-if="intent == 'website'" :value="'play game'">
                Play Game
              </option>
              <option v-if="intent == 'website'" :value="'See offers'">
                See Offers
              </option>
              <option v-if="intent == 'website'" :value="'shop now'">
                Shop Now
              </option>
              <option v-if="intent == 'phone'" :value="'call now'">
                Call Now
              </option>
              <option v-if="intent == 'whatsapp'" :value="'send message'">
                Send Message
              </option>
            </select>
          </div>
        </div>
        <br />
        <label for="description" class="text-aa-dark">Ad description</label>
        <textarea
          id="description"
          v-model="form.description"
          class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
          placeholder="Description of your Ad"
          required
        ></textarea>
        <span class="text-aa-dark">
          Provide a short vivid description of your Ad as you would want others
          to see it <b>(Not more than 100 characters)</b>
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
        <br />
        <div class="float-right">
          <button
            @click="nextStep()"
            class="bg-aa-light text-white py-3 px-5 font-bold focus:outline-none rounded hover:bg-light-700 float-right"
          >
            Next
          </button>
          <button
            @click="previousStep()"
            class="bg-gray-500 text-aa-dark py-3 px-5 font-bold hover:bg-gray-600 focus:outline-none rounded mr-2 float-right"
          >
            Previous
          </button>
        </div>
        <br /><br />
      </div>
    </div>
    <!-- End of step 2 -->

    <!-- Begin step 3 -->
    <div v-if="step == 3">
      <br />
      <!-- Begin bresdcrumb for step 3 -->
      <div class="breadcrumb-wrapper">
        <div class="breadcrumb">
          <a @click="goToStep(1)">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Ad format</span>
              <span class="breadcrumb__desc">Choose ad format</span>
            </span>
          </a>
          <a @click="goToStep(2)">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Configuration</span>
              <span class="breadcrumb__desc">Configure the ad essentials</span>
            </span>
          </a>
          <a href="#" class="active">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Targeting</span>
              <span class="breadcrumb__desc"
                >set target platforms, keywords...</span
              >
            </span>
          </a>
          <a href="#">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">budget</span>
              <span class="breadcrumb__desc"
                >Set your budget and advert duration</span
              >
            </span>
          </a>
          <a href="#">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Upload banner(s)</span>
            </span>
          </a>
        </div>
      </div>
      <!-- End of breadcrumb for step 3 -->
      <br />

      <div class="font-bold text-2xl text-aa-dark p-3">
        <i class="fa fa-bullseye"></i> Targeting & audience
      </div>
      <div
        class="container px-4 py-3 md:px-10 w-full bg-white rounded-lg shadow"
      >
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="bg-gray-100 p-5 rounded">
            <label for="country" class="text-aa-dark font-bold"
              >Target region:</label
            >
            <select
              id="country"
              v-model="form.country"
              class="p-3 border-2 w-full border-gray-300 bg-white rounded focus:outline-none focus:border-link-100"
              multiple
              required
            >
              <option :value="'all'">All</option>
              <option :value="Nigeria">Nigeria</option>
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
              Select which of these countries you would like your advert to be
              diplayed to.
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
              v-model="form.platform"
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
              >Choose from the website categories you would like your advert to
              be displayed on.
            </span>
            <br />
            <select
              id="categories"
              v-model="form.categories"
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
              <option :value="'fashion and design'">Fashion and Design</option>
              <option :value="'religion'">Religion</option>
              <option :value="'education'">Education</option>
              <option :value="'technology'">Technology</option>
              <option :value="'health and fitness'">Health and Fitness</option>
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
              v-model="form.keywords"
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
        <br />
        <div
          id="info"
          class="bg-red-600 text-white p-5 rounded hidden w-full md:w-2/4 animate__animated animate__shakeX"
        >
          Please fill all fields to continue to the next step
        </div>
        <br />
        <div class="float-right">
          <button
            @click="nextStep()"
            class="bg-aa-light text-white py-3 px-5 font-bold focus:outline-none rounded hover:bg-light-700 float-right"
          >
            Next
          </button>
          <button
            @click="previousStep()"
            class="bg-gray-500 text-aa-dark py-3 px-5 font-bold hover:bg-gray-600 focus:outline-none rounded mr-2 float-right"
          >
            Previous
          </button>
        </div>
        <br /><br />
      </div>
    </div>
    <!-- End of step 3 -->

    <!-- Begin step 4 -->
    <div v-if="step == 4">
      <br />
      <!-- Begin breadcrumb for step 4 -->
      <div class="breadcrumb-wrapper">
        <div class="breadcrumb">
          <a @click="goToStep(1)">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Ad format</span>
              <span class="breadcrumb__desc">Choose ad format</span>
            </span>
          </a>
          <a @click="goToStep(2)">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Configuration</span>
              <span class="breadcrumb__desc">Configure the ad essentials</span>
            </span>
          </a>
          <a @click="goToStep(3)">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Targeting</span>
              <span class="breadcrumb__desc"
                >set target platforms, keywords...</span
              >
            </span>
          </a>
          <a class="active">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">budget</span>
              <span class="breadcrumb__desc"
                >Set your budget and advert duration</span
              >
            </span>
          </a>
          <a href="#">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Upload banner(s)</span>
            </span>
          </a>
        </div>
      </div>
      <!-- End of breadcrumb for step 4 -->
      <br />

      <div class="font-bold text-2xl text-aa-dark p-3">
        <i class="fa fa-calendar"></i> Budget & duration
      </div>
      <div
        class="container px-4 py-3 md:px-10 w-full bg-white rounded-lg shadow"
      >
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
                v-model="form.daily_budget"
                value="100"
                id="daily-100"
              /><label for="daily-100">&#160;&#160;{{ showMoney(100) }}</label>
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.daily_budget"
                value="200"
                id="daily-200"
              /><label for="daily-200">&#160;&#160;{{ showMoney(200) }}</label>
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.daily_budget"
                value="400"
                id="daily-400"
              /><label for="daily-400">&#160;&#160;{{ showMoney(400) }}</label>
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.daily_budget"
                value="600"
                id="daily-600"
              /><label for="daily-600">&#160;&#160;{{ showMoney(600) }}</label>
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.daily_budget"
                value="1000"
                id="daily-1000"
              /><label for="daily-1000"
                >&#160;&#160;{{ showMoney(1000) }}</label
              >
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
                v-model="form.daily_budget"
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
                v-model="form.total_budget"
                value="500"
                id="total-500"
              /><label for="total-500">&#160;&#160;{{ showMoney(500) }}</label>
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.total_budget"
                value="1000"
                id="total-1000"
              /><label for="total-1000"
                >&#160;&#160;{{ showMoney(1000) }}</label
              >
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.total_budget"
                value="1500"
                id="total-1500"
              /><label for="total-1500"
                >&#160;&#160;{{ showMoney(1500) }}</label
              >
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.total_budget"
                value="2000"
                id="total-2000"
              /><label for="total-2000"
                >&#160;&#160;{{ showMoney(2000) }}</label
              >
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.total_budget"
                value="5000"
                id="total-5000"
              /><label for="total-5000"
                >&#160;&#160;{{ showMoney(5000) }}</label
              >
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
                v-model="form.total_budget"
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
                v-model="form.cpc"
                value="10"
                id="cpc-10"
              /><label for="cpc-10">&#160;&#160;{{ showMoney(10) }}</label>
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.cpc"
                value="15"
                id="cpc-15"
              /><label for="cpc-15">&#160;&#160;{{ showMoney(15) }}</label>
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.cpc"
                value="20"
                id="cpc-20"
              /><label for="cpc-20">&#160;&#160;{{ showMoney(20) }}</label>
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.cpc"
                value="25"
                id="cpc-25"
              /><label for="cpc-25">&#160;&#160;{{ showMoney(25) }}</label>
            </div>
            <div class="py-1 text-xl">
              <input
                type="radio"
                v-model="form.cpc"
                value="50"
                id="cpc-50"
              /><label for="cpc-50">&#160;&#160;{{ showMoney(50) }}</label>
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
                v-model="form.cpc"
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
              >How long do you want to run this ad? Choose a date when it should
              be stopped</span
            >)
            <br />
            <input
              type="date"
              class="p-4 border-2 border-gray-300 rounded focus:outline-none focus:border-link-100"
              v-model="form.duration"
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
        <br />
        <div
          id="info-4"
          class="bg-red-600 text-white p-5 rounded hidden w-full md:w-2/4 animate__animated animate__shakeX"
        >
          Please fill all fields to continue to the next step
        </div>
        <br />
        <div class="float-right">
          <button
            @click="nextStep()"
            class="bg-aa-light text-white py-3 px-5 font-bold focus:outline-none rounded hover:bg-light-700 float-right"
          >
            Next
          </button>
          <button
            @click="previousStep()"
            class="bg-gray-500 text-aa-dark py-3 px-5 font-bold hover:bg-gray-600 focus:outline-none rounded mr-2 float-right"
          >
            Previous
          </button>
        </div>
        <br /><br />
      </div>
    </div>
    <!-- End of step 4 -->
    <!-- Begin step 5 -->
    <div v-if="step == 5">
      <br />
      <!-- Begin breadcrumb for step 5 -->
      <div class="breadcrumb-wrapper">
        <div class="breadcrumb">
          <a @click="goToStep(1)">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Ad format</span>
              <span class="breadcrumb__desc">Choose ad format</span>
            </span>
          </a>
          <a @click="goToStep(2)">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Configuration</span>
              <span class="breadcrumb__desc">Configure the ad essentials</span>
            </span>
          </a>
          <a @click="goToStep(3)">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Targeting</span>
              <span class="breadcrumb__desc"
                >set target platforms, keywords...</span
              >
            </span>
          </a>
          <a @click="goToStep(4)">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">budget</span>
              <span class="breadcrumb__desc"
                >Set your budget and advert duration</span
              >
            </span>
          </a>
          <a class="active">
            <span class="breadcrumb__inner">
              <span class="breadcrumb__title">Upload banner(s)</span>
            </span>
          </a>
        </div>
      </div>
      <!-- End of breadcrumb for step 4 -->
      <br />

      <div class="font-bold text-2xl text-aa-dark p-3">
        <i class="fa fa-photo"></i> Upload banner(s)
      </div>
      <div
        class="container px-4 py-3 md:px-10 w-full bg-white rounded-lg shadow"
      >
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
          >You can upload a maximum of <b>5 banners</b>, use control-click to
          select more than 1 file on <b>Windows</b> or command-click on
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
          >Your submitted data contains error(s), navigate through the form to
          correct them</span
        ><br /><br />
        <button
          v-if="files.length > 0 && files.length < 6"
          @click="submitAdvert()"
          v-bind:class="{
            'cursor-not-allowed opacity-75 text-gray-300': formIsLoading,
          }"
          class="bg-aa-light text-white py-3 px-5 font-bold focus:outline-none rounded-md hover:bg-light-700 float-right"
        >
          <div class="flex">
            <div class="px-1">
              <div v-bind:class="{ spinner: formIsLoading }"></div>
            </div>

            <div><i class="fa fa-check"></i> Save advert</div>
          </div>
        </button>
        <button
          v-if="files.length > 0 && files.length < 6"
          @click="displayPreview()"
          class="bg-gray-500 text-aa-dark py-3 px-5 font-bold hover:bg-gray-600 focus:outline-none rounded-md mr-2 float-right"
        >
          <i class="fa fa-eye"></i> Display preview
        </button>
        <button
          @click="previousStep()"
          class="bg-gray-500 text-aa-dark py-3 px-5 font-bold hover:bg-gray-600 focus:outline-none rounded-md mr-2 float-right"
        >
          Previous
        </button>

        <br /><br /><br /><br />
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

// Import component
import Loading from "vue-loading-overlay";

// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";

//Import Noty for notifications
import VueNoty from "vuejs-noty";

Vue.use(VueNoty);

//Import noty styles
import "vuejs-noty/dist/vuejs-noty.css";

export default {
  props: ["user", "intent"],

  components: {
    Loading,
  },

  data() {
    return {
      isLoading: false,
      fullPage: true,
      formIsLoading: false,
      form: {
        action_btn: "Learn more",
        daily_budget: 400,
        total_budget: 1500,
        cpc: 20,
        duration: "",
        country: ["all"],
        platform: ["all"],
        categories: ["all"],
        objectiveMsg: "",
        imageOne: "image-ad.png",
        imageTwo: "carousel-ad.png",
        imageThree: "responsive-ad.png",
      },
      form_error: {
        user_id: null,
        title: null,
        url: null,
        subtext: null,
        action_btn: null,
        description: null,
        keywords: null,
        platforms: null,
        categories: null,
        country: null,
        daily_budget: null,
        total_budget: null,
        cpc: null,
        duration: null,
        format: null,
      },
      files: [],
      step: 1,
    };
  },

  created() {
    this.generateFormCredentials();
    this.setDurationDate();
  },

  methods: {
    setDurationDate() {
      let now = new Date();
      let milliseconds = now.getTime();
      let plus = milliseconds + 604800000;
      let date = new Date(plus);
      let month = 1 + date.getMonth();
      this.form.duration =
        date.getFullYear() + "-" + month + "-" + 0 + date.getDate();
    },

    nextStep(format = null) {
      // if (this.step == 2) {
      if (this.step > 1 && this.validate(this.step) == false) {
        return false;
      }
      // }
      this.step++;
      if (format) {
        this.form.format = format;
      }
    },
    previousStep() {
      this.step--;
    },

    goToStep(step) {
      this.step = step;
    },

    validate(step) {
      switch (step) {
        case 2:
          let stepOne = [
            "title",
            "url",
            "subtext",
            "action_btn",
            "description",
          ];
          for (var i = 0; i < stepOne.length; i++) {
            let doc = document.querySelector("#" + stepOne[i]);
            if (doc.value == "") {
              doc.classList.add("border-red-600");
              return false;
            }
          }
          return true;
          break;
        case 3:
          let keywords = document.querySelector("#keywords");
          if (keywords.value == "") {
            keywords.classList.add("border-red-600");
            return false;
          }
          return true;
          break;
        case 4:
          if (
            this.form.daily_budget < 100 ||
            this.form.total_budget < 500 ||
            this.form.cpc < 10
          ) {
            document.querySelector("#info-4").style.display = "block";
          } else {
            document.querySelector("#info-4").style.display = "none";
          }

          if (this.form.daily_budget < 100) {
            let daily = document.querySelector("#daily-manual-entry");
            daily.classList.add("border-red-600");
            return false;
          }
          if (this.form.total_budget < 500) {
            document
              .querySelector("#total-manual-entry")
              .classList.add("border-red-600");
            return false;
          }
          if (this.form.cpc < 10) {
            document
              .querySelector("#cpc-manual-entry")
              .classList.add("border-red-600");
            return false;
          }
      }
    },

    generateFormCredentials() {
      let intent = this.intent;
      if (intent == "website") {
        this.form.objectiveMsg = "Drive traffic to your website";
        this.form.imageOne = "image-ad.png";
        this.form.imageTwo = "carousel-ad.png";
        this.form.imageThree = "responsive-ad.png";
      } else if (intent == "whatsapp") {
        this.form.action_btn = "send message";
        this.form.objectiveMsg = "Get whatsapp message(s)";
        this.form.imageOne = "image-ad.png";
        this.form.imageTwo = "carousel-ad.png";
        this.form.imageThree = "send-message.png";
      } else if (intent == "phone") {
        this.form.action_btn = "call now";
        this.form.objectiveMsg = "Get phone call(s)";
        this.form.imageOne = "image-ad.png";
        this.form.imageTwo = "carousel-ad.png";
        this.form.imageThree = "call-now.png";
      }
    },

    showMoney(amountInNaira) {
      if (this.user.currency == "NGN") {
        return new Intl.NumberFormat("en-NG", {
          style: "currency",
          currency: "NGN",
        }).format(amountInNaira);
      } else if (this.user.currency == "USD") {
        let amountInUsd = amountInNaira / 360;
        return new Intl.NumberFormat("en-US", {
          style: "currency",
          currency: "USD",
        }).format(amountInUsd);
      }
    },

    showManualEntry(budget) {
      switch (budget) {
        case "daily_budget":
          this.form.daily_budget = 0;
          let dailyBudget = document.querySelector("#daily-manual-entry");
          dailyBudget.style.display = "block";
          break;
        case "total_budget":
          this.form.total_budget = 0;
          let totalBudget = document.querySelector("#total-manual-entry");
          totalBudget.style.display = "block";
          break;
        case "cpc":
          this.form.cpc = 0;
          let cpc = document.querySelector("#cpc-manual-entry");
          cpc.style.display = "block";
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

    submitAdvert() {
      this.formIsLoading = true;
      /*
    Initialize the form data
  */
      let formData = new FormData();

      /*
    Iteate over any file sent over appending the files
    to the form data.
  */
      for (var i = 0; i < this.files.length; i++) {
        let file = this.files[i];

        formData.append("files[" + i + "]", file);
      }

      formData.append("user_id", this.user.id);
      formData.append("format", this.form.format);
      formData.append("advert_intent", this.intent);
      formData.append("title", this.form.title);
      formData.append("url", this.form.url);
      formData.append("subtext", this.form.subtext);
      formData.append("action_btn", this.form.action_btn);
      formData.append("description", this.form.description);
      formData.append("country", this.form.country);
      formData.append("keywords", this.form.keywords);
      formData.append("categories", this.form.categories);
      formData.append("platforms", this.form.platform);
      formData.append("daily_budget", this.form.daily_budget);
      formData.append("total_budget", this.form.total_budget);
      formData.append("cpc", this.form.cpc);
      formData.append("duration", this.form.duration);

      /*
    Make the request to the POST /select-files URL
  */
      axios
        .post(`${this.$root.$data.api}/adverts/adsetup`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.formIsLoading = false;
          this.$noty.success("Advert setup complete", {
            layout: "topRight",
            theme: "metroui",
          });
          this.isLoading = true;
          setTimeout(() => {
            if (this.user.advertiser_balance > this.form.total_budget) {
              window.location.replace("/a/adverts");
            } else {
              window.location.replace("/a/account");
            }
          }, 2000);
        })
        .catch((error) => {
          this.formIsLoading = false;
          error.response.data.indexOf("title")
            ? (this.form_error.title = error.response.data[0].title)
            : null;
          error.response.data.indexOf("url")
            ? (this.form_error.url = error.response.data[0].url)
            : null;
          error.response.data.indexOf("subtext")
            ? (this.form_error.subtext = error.response.data[0].subtext)
            : null;
          error.response.data.indexOf("description")
            ? (this.form_error.description = error.response.data[0].description)
            : null;
          error.response.data.indexOf("keywords")
            ? (this.form_error.keywords = error.response.data[0].keywords)
            : null;
          error.response.data.indexOf("daily_budget")
            ? (this.form_error.daily_budget =
                error.response.data[0].daily_budget)
            : null;
          error.response.data.indexOf("total_budget")
            ? (this.form_error.total_budget =
                error.response.data[0].total_budget)
            : null;
          error.response.data.indexOf("cpc")
            ? (this.form_error.cpc = error.response.data[0].cpc)
            : null;
          error.response.data.indexOf("files")
            ? (this.form_error.files = error.response.data[0].files)
            : null;
          error.response.data.indexOf("format")
            ? (this.form_error.format = error.response.data[0].format)
            : null;
          document.querySelector("#error-all").style.display = "block";
        });
    },

    clearFiles() {
      this.files = [];
    },
  },
};
</script>
<style scoped>
input[type="file"] {
  position: absolute;
  top: -500px;
}
div.file-listing img {
  max-width: 90%;
}
</style>