@extends('layouts.app')

@section('content')
    @php
        $fee = 37.00;
        $currency = 'MYR';
    @endphp

    <main id="main">
        <section class="section pb-2">
            <div class="container pt-5">
                <div class="row justify-content-center">
                    <div class="col-md-10 m-auto border-bottom">
                        <h2 class="mb-4">Let's get started</h2>
                        <p class="mb-4 px-2">
                            The test will take approximately 15 minutes. Should you need
                            to take a break or stop for any reason, be sure to resume using the link that was
                            emailed to you. Once you complete the career test, you will receive your
                            personalized career report. Thank you!
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 m-auto">
                        <h3 class="mb-4">Personal Information</h3>
                        <form method="POST" action="{{ route('registration.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="firstname">First Name*</label>
                                    <input type="text" name="firstname"
                                        class="form-control @error('firstname') is-invalid @enderror" id="firstname"
                                        value="{{ old('firstname') }}" required />
                                    @error('firstname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="lastname">Last Name*</label>
                                    <input type="text" name="lastname"
                                        class="form-control @error('lastname') is-invalid @enderror" id="lastname"
                                        value="{{ old('lastname') }}" required />
                                    @error('lastname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label for="age">Age*</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control @error('age') is-invalid @enderror"
                                                name="age" id="age" min="10" max="80" value="{{ old('age') }}" required />
                                            @error('age')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 form-group pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label for="gender">Gender*</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Male
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> Female
                                        </div>
                                    </div>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 form-group pt-3">
                                    <label for="stgroup">Group*</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="radio" name="stgroup" value="Student" {{ old('stgroup') == 'Student' ? 'checked' : '' }}> Student
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" name="stgroup" value="College/University" {{ old('stgroup') == 'College/University' ? 'checked' : '' }}> College/University
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" name="stgroup" value="Working Adult" {{ old('stgroup') == 'Working Adult' ? 'checked' : '' }}> Working Adult
                                        </div>
                                    </div>
                                    @error('stgroup')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="email">Email*</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        value="{{ old('email') }}" required />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="country">Country*</label>
                                    <section>
                                        <select id="country" class="form-control @error('country') is-invalid @enderror"
                                            name="country" required>
                                            <option value="MY" {{ old('country') == 'MY' ? 'selected' : '' }}>Malaysia
                                            </option>
                                            <option value="AF" {{ old('country') == 'AF' ? 'selected' : '' }}>Afghanistan
                                            </option>
                                            <option value="AL" {{ old('country') == 'AL' ? 'selected' : '' }}>Albania</option>
                                            <option value="DZ" {{ old('country') == 'DZ' ? 'selected' : '' }}>Algeria</option>
                                            <option value="AS" {{ old('country') == 'AS' ? 'selected' : '' }}>American Samoa
                                            </option>
                                            <option value="AD" {{ old('country') == 'AD' ? 'selected' : '' }}>Andorra</option>
                                            <option value="AO" {{ old('country') == 'AO' ? 'selected' : '' }}>Angola</option>
                                            <option value="AI" {{ old('country') == 'AI' ? 'selected' : '' }}>Anguilla
                                            </option>
                                            <option value="AQ" {{ old('country') == 'AQ' ? 'selected' : '' }}>Antarctica
                                            </option>
                                            <option value="AG" {{ old('country') == 'AG' ? 'selected' : '' }}>Antigua and
                                                Barbuda</option>
                                            <option value="AR" {{ old('country') == 'AR' ? 'selected' : '' }}>Argentina
                                            </option>
                                            <option value="AM" {{ old('country') == 'AM' ? 'selected' : '' }}>Armenia</option>
                                            <option value="AW" {{ old('country') == 'AW' ? 'selected' : '' }}>Aruba</option>
                                            <option value="AU" {{ old('country') == 'AU' ? 'selected' : '' }}>Australia
                                            </option>
                                            <option value="AT" {{ old('country') == 'AT' ? 'selected' : '' }}>Austria</option>
                                            <option value="AZ" {{ old('country') == 'AZ' ? 'selected' : '' }}>Azerbaijan
                                            </option>
                                            <option value="BS" {{ old('country') == 'BS' ? 'selected' : '' }}>Bahamas</option>
                                            <option value="BH" {{ old('country') == 'BH' ? 'selected' : '' }}>Bahrain</option>
                                            <option value="BD" {{ old('country') == 'BD' ? 'selected' : '' }}>Bangladesh
                                            </option>
                                            <option value="BB" {{ old('country') == 'BB' ? 'selected' : '' }}>Barbados
                                            </option>
                                            <option value="BY" {{ old('country') == 'BY' ? 'selected' : '' }}>Belarus</option>
                                            <option value="BE" {{ old('country') == 'BE' ? 'selected' : '' }}>Belgium</option>
                                            <option value="BZ" {{ old('country') == 'BZ' ? 'selected' : '' }}>Belize</option>
                                            <option value="BJ" {{ old('country') == 'BJ' ? 'selected' : '' }}>Benin</option>
                                            <option value="BM" {{ old('country') == 'BM' ? 'selected' : '' }}>Bermuda</option>
                                            <option value="BT" {{ old('country') == 'BT' ? 'selected' : '' }}>Bhutan</option>
                                            <option value="BO" {{ old('country') == 'BO' ? 'selected' : '' }}>Bolivia</option>
                                            <option value="BA" {{ old('country') == 'BA' ? 'selected' : '' }}>Bosnia and
                                                Herzegovina</option>
                                            <option value="BW" {{ old('country') == 'BW' ? 'selected' : '' }}>Botswana
                                            </option>
                                            <option value="BR" {{ old('country') == 'BR' ? 'selected' : '' }}>Brazil</option>
                                            <option value="BN" {{ old('country') == 'BN' ? 'selected' : '' }}>Brunei
                                                Darussalam</option>
                                            <option value="BG" {{ old('country') == 'BG' ? 'selected' : '' }}>Bulgaria
                                            </option>
                                            <option value="BF" {{ old('country') == 'BF' ? 'selected' : '' }}>Burkina Faso
                                            </option>
                                            <option value="BI" {{ old('country') == 'BI' ? 'selected' : '' }}>Burundi</option>
                                            <option value="KH" {{ old('country') == 'KH' ? 'selected' : '' }}>Cambodia
                                            </option>
                                            <option value="CM" {{ old('country') == 'CM' ? 'selected' : '' }}>Cameroon
                                            </option>
                                            <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada</option>
                                            <option value="CV" {{ old('country') == 'CV' ? 'selected' : '' }}>Cabo Verde
                                            </option>
                                            <option value="KY" {{ old('country') == 'KY' ? 'selected' : '' }}>Cayman Islands
                                            </option>
                                            <option value="CF" {{ old('country') == 'CF' ? 'selected' : '' }}>Central African
                                                Republic</option>
                                            <option value="TD" {{ old('country') == 'TD' ? 'selected' : '' }}>Chad</option>
                                            <option value="CL" {{ old('country') == 'CL' ? 'selected' : '' }}>Chile</option>
                                            <option value="CN" {{ old('country') == 'CN' ? 'selected' : '' }}>China</option>
                                            <option value="CO" {{ old('country') == 'CO' ? 'selected' : '' }}>Colombia
                                            </option>
                                            <option value="KM" {{ old('country') == 'KM' ? 'selected' : '' }}>Comoros</option>
                                            <option value="CG" {{ old('country') == 'CG' ? 'selected' : '' }}>Congo</option>
                                            <option value="CR" {{ old('country') == 'CR' ? 'selected' : '' }}>Costa Rica
                                            </option>
                                            <option value="CU" {{ old('country') == 'CU' ? 'selected' : '' }}>Cuba</option>
                                            <option value="CY" {{ old('country') == 'CY' ? 'selected' : '' }}>Cyprus</option>
                                            <option value="CZ" {{ old('country') == 'CZ' ? 'selected' : '' }}>Czech Republic
                                            </option>
                                            <option value="DK" {{ old('country') == 'DK' ? 'selected' : '' }}>Denmark</option>
                                            <option value="DJ" {{ old('country') == 'DJ' ? 'selected' : '' }}>Djibouti
                                            </option>
                                            <option value="DM" {{ old('country') == 'DM' ? 'selected' : '' }}>Dominica
                                            </option>
                                            <option value="DO" {{ old('country') == 'DO' ? 'selected' : '' }}>Dominican
                                                Republic</option>
                                            <option value="EC" {{ old('country') == 'EC' ? 'selected' : '' }}>Ecuador</option>
                                            <option value="EG" {{ old('country') == 'EG' ? 'selected' : '' }}>Egypt</option>
                                            <option value="SV" {{ old('country') == 'SV' ? 'selected' : '' }}>El Salvador
                                            </option>
                                            <option value="GQ" {{ old('country') == 'GQ' ? 'selected' : '' }}>Equatorial
                                                Guinea</option>
                                            <option value="ER" {{ old('country') == 'ER' ? 'selected' : '' }}>Eritrea</option>
                                            <option value="EE" {{ old('country') == 'EE' ? 'selected' : '' }}>Estonia</option>
                                            <option value="SZ" {{ old('country') == 'SZ' ? 'selected' : '' }}>Eswatini
                                            </option>
                                            <option value="ET" {{ old('country') == 'ET' ? 'selected' : '' }}>Ethiopia
                                            </option>
                                            <option value="FI" {{ old('country') == 'FI' ? 'selected' : '' }}>Finland</option>
                                            <option value="FR" {{ old('country') == 'FR' ? 'selected' : '' }}>France</option>
                                            <option value="GE" {{ old('country') == 'GE' ? 'selected' : '' }}>Georgia</option>
                                            <option value="DE" {{ old('country') == 'DE' ? 'selected' : '' }}>Germany</option>
                                            <option value="GH" {{ old('country') == 'GH' ? 'selected' : '' }}>Ghana</option>
                                            <option value="GR" {{ old('country') == 'GR' ? 'selected' : '' }}>Greece</option>
                                            <option value="GT" {{ old('country') == 'GT' ? 'selected' : '' }}>Guatemala
                                            </option>
                                            <option value="GU" {{ old('country') == 'GU' ? 'selected' : '' }}>Guam</option>
                                            <option value="GY" {{ old('country') == 'GY' ? 'selected' : '' }}>Guyana</option>
                                            <option value="HN" {{ old('country') == 'HN' ? 'selected' : '' }}>Honduras
                                            </option>
                                            <option value="HK" {{ old('country') == 'HK' ? 'selected' : '' }}>Hong Kong
                                            </option>
                                            <option value="HU" {{ old('country') == 'HU' ? 'selected' : '' }}>Hungary</option>
                                            <option value="IN" {{ old('country') == 'IN' ? 'selected' : '' }}>India</option>
                                            <option value="ID" {{ old('country') == 'ID' ? 'selected' : '' }}>Indonesia
                                            </option>
                                            <option value="IR" {{ old('country') == 'IR' ? 'selected' : '' }}>Iran</option>
                                            <option value="IQ" {{ old('country') == 'IQ' ? 'selected' : '' }}>Iraq</option>
                                            <option value="IE" {{ old('country') == 'IE' ? 'selected' : '' }}>Ireland</option>
                                            <option value="IL" {{ old('country') == 'IL' ? 'selected' : '' }}>Israel</option>
                                            <option value="IT" {{ old('country') == 'IT' ? 'selected' : '' }}>Italy</option>
                                            <option value="JP" {{ old('country') == 'JP' ? 'selected' : '' }}>Japan</option>
                                            <option value="KE" {{ old('country') == 'KE' ? 'selected' : '' }}>Kenya</option>
                                            <option value="KR" {{ old('country') == 'KR' ? 'selected' : '' }}>South Korea
                                            </option>
                                            <option value="KW" {{ old('country') == 'KW' ? 'selected' : '' }}>Kuwait</option>
                                            <option value="LB" {{ old('country') == 'LB' ? 'selected' : '' }}>Lebanon</option>
                                            <option value="LR" {{ old('country') == 'LR' ? 'selected' : '' }}>Liberia</option>
                                            <option value="LK" {{ old('country') == 'LK' ? 'selected' : '' }}>Sri Lanka
                                            </option>
                                            <option value="LT" {{ old('country') == 'LT' ? 'selected' : '' }}>Lithuania
                                            </option>
                                            <option value="LU" {{ old('country') == 'LU' ? 'selected' : '' }}>Luxembourg
                                            </option>
                                            <option value="LV" {{ old('country') == 'LV' ? 'selected' : '' }}>Latvia</option>
                                            <option value="MO" {{ old('country') == 'MO' ? 'selected' : '' }}>Macao</option>
                                            <option value="MX" {{ old('country') == 'MX' ? 'selected' : '' }}>Mexico</option>
                                            <option value="NG" {{ old('country') == 'NG' ? 'selected' : '' }}>Nigeria</option>
                                            <option value="NO" {{ old('country') == 'NO' ? 'selected' : '' }}>Norway</option>
                                            <option value="NP" {{ old('country') == 'NP' ? 'selected' : '' }}>Nepal</option>
                                            <option value="NL" {{ old('country') == 'NL' ? 'selected' : '' }}>Netherlands
                                            </option>
                                            <option value="NZ" {{ old('country') == 'NZ' ? 'selected' : '' }}>New Zealand
                                            </option>
                                            <option value="PK" {{ old('country') == 'PK' ? 'selected' : '' }}>Pakistan
                                            </option>
                                            <option value="PE" {{ old('country') == 'PE' ? 'selected' : '' }}>Peru</option>
                                            <option value="PH" {{ old('country') == 'PH' ? 'selected' : '' }}>Philippines
                                            </option>
                                            <option value="PL" {{ old('country') == 'PL' ? 'selected' : '' }}>Poland</option>
                                            <option value="PT" {{ old('country') == 'PT' ? 'selected' : '' }}>Portugal
                                            </option>
                                            <option value="QA" {{ old('country') == 'QA' ? 'selected' : '' }}>Qatar</option>
                                            <option value="RO" {{ old('country') == 'RO' ? 'selected' : '' }}>Romania</option>
                                            <option value="RU" {{ old('country') == 'RU' ? 'selected' : '' }}>Russia</option>
                                            <option value="SA" {{ old('country') == 'SA' ? 'selected' : '' }}>Saudi Arabia
                                            </option>
                                            <option value="SG" {{ old('country') == 'SG' ? 'selected' : '' }}>Singapore
                                            </option>
                                            <option value="ZA" {{ old('country') == 'ZA' ? 'selected' : '' }}>South Africa
                                            </option>
                                            <option value="ES" {{ old('country') == 'ES' ? 'selected' : '' }}>Spain</option>
                                            <option value="SE" {{ old('country') == 'SE' ? 'selected' : '' }}>Sweden</option>
                                            <option value="CH" {{ old('country') == 'CH' ? 'selected' : '' }}>Switzerland
                                            </option>
                                            <option value="TH" {{ old('country') == 'TH' ? 'selected' : '' }}>Thailand
                                            </option>
                                            <option value="TR" {{ old('country') == 'TR' ? 'selected' : '' }}>Turkey</option>
                                            <option value="UA" {{ old('country') == 'UA' ? 'selected' : '' }}>Ukraine</option>
                                            <option value="GB" {{ old('country') == 'GB' ? 'selected' : '' }}>United Kingdom
                                            </option>
                                            <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>United States
                                            </option>
                                            <option value="VE" {{ old('country') == 'VE' ? 'selected' : '' }}>Venezuela
                                            </option>
                                            <option value="VN" {{ old('country') == 'VN' ? 'selected' : '' }}>Vietnam</option>
                                            <option value="ZW" {{ old('country') == 'ZW' ? 'selected' : '' }}>Zimbabwe
                                            </option>
                                        </select>
                                    </section>
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="state">State*</label>
                                    <input type="text" name="state"
                                        class="form-control @error('state') is-invalid @enderror" id="state"
                                        value="{{ old('state') }}" required />
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Default Language Selection (Automatically set to 'en') -->
                                <div class="col-md-12 form-group d-flex">
                                    <label for="test_lang">Preferred Language*</label>
                                    <select id="test_lang" class="form-control @error('test_lang') is-invalid @enderror"
                                        name="test_lang" required>
                                        <option value="en" {{ old('test_lang', 'en') == 'en' ? 'selected' : '' }}>English
                                        </option>
                                        <option value="malay" {{ old('test_lang') == 'malay' ? 'selected' : '' }}>Malay
                                        </option>
                                    </select>

                                    @error('test_lang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 form-group">
                                    <label>
                                        <h3>Career Preference Test is now Completely Free</h3>
                                    </label>
                                </div>

                                <div class="col-md-12 form-group mb-3">
                                    <label class="d-block mb-2">Please Acknowledge</label>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input @error('consent') is-invalid @enderror"
                                            type="checkbox"
                                            id="consent"
                                            name="consent"
                                            value="1"
                                            {{ old('consent') ? 'checked' : '' }}
                                            required
                                        />
                                        <label class="form-check-label" for="consent">
                                            Yes, I would like to proceed with the Free Career Test. In doing so, I consent to join the mailing list and look forward to receiving career guidance materials tailored to my interests.
                                        </label>
                                        @error('consent')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 m-auto form-group mt-5">
                                    <button type="submit" class="btn btn-primary btn-form d-block w-100 mt-5">
                                        Start Test
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
