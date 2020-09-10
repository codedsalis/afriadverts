@extends('layouts.app-guest')

@section('title', 'Registration')

@section('content')

    <div class="flex justify-around mt-12">


        <div class="flex flex-col rounded-md shadow-lg w-2/3 md:w-2/4 lg:w-2/5 xl:w-1/3">
            <div class="bg-gray-200 p-3 rounded-b-none rounded-t-md text-2xl">
                {{ __('Register') }}
            </div>
            <div class="bg-white p-4 rounded-b-md">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="firstname">First Name</label>
                            <br />
                            <input id="firstname" type="text"
                                class="border border-gray-300 w-full rounded p-3 @error('firstname') border border-red-700 @enderror"
                                name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                            @error('firstname')
                            <span class="text-red-700" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label for="lastname">Last Name</label>
                            <br />
                            <input id="lastname" type="text"
                                class="border border-gray-300 w-full rounded p-3 @error('lastname') border border-red-700 @enderror"
                                name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                            @error('lastname')
                            <span class="text-red-700" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email"
                                class="border border-gray-300 w-full rounded p-3 @error('email') border border-red-700 @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="text-red-700" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label for="country">Country</label>
                            <select name="country"
                                class="border border-gray-300 w-full rounded p-3 @error('country') border border-red-700 @enderror"
                                name="country" value="{{ old('country') }}" required autocomplete="country">
                                <option value="Afghanistan"> Afghanistan</option>
                                <option value="Albania"> Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="Andorra">Andorra </option>
                                <option value="Angola">Angola </option>
                                <option value="Argentina"> Argentina</option>
                                <option value="Armenia">Armenia </option>
                                <option value="Australia">Australia</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas"> Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh"> Bangladesh</option>
                                <option value="Barbados"> Barbados</option>
                                <option value="Belarus"> Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina"> Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Brunei">Brunei </option>
                                <option value="Bulgaria"> Bulgaria</option>
                                <option value="Burkina Faso"> Burkina Faso </option>
                                <option value="Burundi"> Burundi</option>
                                <option value="Cabo Verde"> Cabo Verde</option>
                                <option value="Cambodia"> Cambodia</option>
                                <option value="Cameroon"> Cameroon</option>
                                <option value="Canada"> Canada</option>
                                <option value="Chad"> Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Columbia">Columbia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Costa Rica"> Costa Rica</option>
                                <option value="Cote d\'Ivoire"> Cote d\'Ivoire</option>
                                <option value="Croatia"> Croatia</option>
                                <option value="Cuba"> Cuba</option>
                                <option value="Cyprus"> Cyprus</option>
                                <option value="Czech Republic"> Czech Republic</option>
                                <option value="Denmark"> Denmark</option>
                                <option value="Djibouti"> Djibouti</option>
                                <option value="Dominica"> Dominica</option>
                                <option value="Dominican Republic"> Dominican Republic</option>
                                <option value="Ecuador"> Ecuador</option>
                                <option value="Egypt"> Egypt</option>
                                <option value="El Salvador"> El Salvador</option>
                                <option value="Equatorial Guinea"> Equatorial Guinea</option>
                                <option value="Estonia"> Estonia</option>
                                <option value="Ethiopia"> Ethiopia</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Greece">Greece</option>
                                <option value="Grenada">Grenada </option>
                                <option value="Guatemala"> Guatemala </option>
                                <option value="Guinea"> Guinea</option>
                                <option value="Guyana"> Guyana</option>
                                <option value="Haiti"> Haiti</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Kosovo">Kosovo</option>
                                <option value="Kuwait">Kuwait </option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Laos">Laos</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macedonia">Macedonia</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius </option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia">Micronesia</option>
                                <option value="Moldova">Moldova </option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="North Korea">North Korea</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman </option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestine">Palestine </option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Romania">Romania</option>
                                <option value="Russia">Russia</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Kitts and Nevis"> Saint Kitts and Nevis </option>
                                <option value="Saint Lucia"> Saint Lucia </option>
                                <option value="Saint Vincent and the Grenadines"> Saint Vincent and the Grenadines </option>
                                <option value="Samoa"> Samoa </option>
                                <option value="San Marino"> San Marino </option>
                                <option value="Sao Tome and Principe"> Sao Tome and Principe </option>
                                <option value="Saudi Arabia"> Saudi Arabia </option>
                                <option value="Senegal"> Senegal </option>
                                <option value="Serbia"> Serbia </option>
                                <option value="Seychelles"> Seychelles </option>
                                <option value="Sierra Leone"> Sierra Leone </option>
                                <option value="Singapore"> Singapore </option>
                                <option value="Slovakia"> Slovakia </option>
                                <option value="Slovenia"> Slovenia </option>
                                <option value="Solomon Islands"> Solomon Islands </option>
                                <option value="Somalia"> Somalia </option>
                                <option value="South Africa"> South Africa </option>
                                <option value="South Korea"> South Korea </option>
                                <option value="South Sudan"> South Sudan </option>
                                <option value="Spain"> Spain </option>
                                <option value="Sri Lanka"> Sri Lanka </option>
                                <option value="Sudan"> Sudan </option>
                                <option value="Suriname"> Suriname </option>
                                <option value="Swaziland"> Swaziland </option>
                                <option value="Sweden"> Sweden </option>
                                <option value="Switzerland"> Switzerland </option>
                                <option value="Syria"> Syria </option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-Leste">Timor-Leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Tuvalu"> Tuvalu</option>
                                <option value="Uganda"> Uganda </option>
                                <option value="Ukraine"> Ukraine </option>
                                <option value="United Arab Emirates"> United Arab Emirates </option>
                                <option value="United Kingdom"> United Kingdom </option>
                                <option value="United States of America"> United States of America </option>
                                <option value="Uruguay"> Uruguay </option>
                                <option value="Uzbekistan"> Uzbekistan </option>
                                <option value="Vanuatu"> Vanuatu </option>
                                <option value="Vatican City"> Vatican City </option>
                                <option value="Venezuela"> Venezuela </option>
                                <option value="Vietnam"> Vietnam </option>
                                <option value="Yemen"> Yemen </option>
                                <option value="Zambia"> Zambia </option>
                                <option value="Zimbabwe"> Zimbabwe </option>
                            </select>

                            @error('country')
                            <span class="text-red-700" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="border border-gray-300 w-full rounded p-3 @error('password') border border-red-700 @enderror"
                                name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="text-red-700" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div>
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="border border-gray-300 w-full rounded p-3"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <br />
                    <input class="m-4 mr-0" type="checkbox" name="agreement" id="agreement"
                        {{ old('agreement') ? 'checked' : '' }} checked="checked" onclick="watchAgreementCheck()">
                    <label for="agreement">
                        By clicking the register button below, you agree to our <a
                            href="https://afriadverts.com/afriadverts-publishers-policies/"
                            class="text-aa-light hover:text-aa-light-active" target="_blank">Terms and Conditions</a>
                    </label>
                    <br /><br />
                    <div class="flex justify-center">
                        <button id="submit-btn" type="submit"
                            class="btn-dark w-full hover:bg-aa-darker transform focus:bg-aa-darker hover:scale-105">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
