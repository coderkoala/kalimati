<?php

return array (
  'required' => ':attribute क्षेत्र आवश्यक छ।',
  'min' => 
  array (
    'string' => ':attribute कम्तिमा :min अक्षरको हुनुपर्छ।',
    'numeric' => ':attribute कम्तिमा :min हुनुपर्छ।',
    'file' => ':attribute कम्तिमा :min किलोबाइट हुनुपर्छ।',
    'array' => ':attribute ,मा कम्तिमा :min वस्तुहरू हुनुपर्छ।',
  ),
  'accepted' => ':attribute स्वीकार गर्नुपर्छ।',
  'accepted_if' => ':attribute स्वीकार्नु पर्छ जब :other :value छ।',
  'active_url' => ':attribute मान्य यु-र-एल होइन।',
  'after' => ':attribute :date पछिको मितिमा हुनुपर्छ।',
  'after_or_equal' => ':attribute पछिको वा बराबरको :date  हुनुपर्छ।',
  'alpha' => ':attribute ले अक्षर मात्र समावेश गर्नुपर्छ।',
  'alpha_dash' => ':attribute ले अक्षरहरू, सङ्ख्याहरू, ड्यासहरू र अन्डरस्कोरहरू मात्र समावेश गर्नुपर्छ।',
  'alpha_num' => ':attribute ले अक्षर र संख्या मात्र समावेश गर्नुपर्छ।',
  'array' => ':attribute एरे हुनुपर्छ।',
  'before' => ':attribute :date अघिको मिति हुनुपर्छ।',
  'before_or_equal' => ':attribute :date अघि वा बराबरको मिति हुनुपर्छ।',
  'between' => 
  array (
    'numeric' => ':attribute :min र :max को बीचमा हुनुपर्छ।',
    'file' => ':attribute :min र :max किलोबाइट बीचको हुनुपर्छ।',
    'string' => ':attribute :min र :max अक्षरको बीचमा हुनुपर्छ।',
    'array' => ':attrobite :min र :max वस्तुहरू बीच हुनुपर्छ।',
  ),
  'boolean' => ':attribute ठाउँ सत्य वा गलत हुनुपर्छ।',
  'confirmed' => ':attribute पुष्टिकरण मेल खाँदैन।',
  'current_password' => 'पासवर्ड गलत छ।',
  'date' => ':attribute मान्य मिति होइन।',
  'date_equals' => ':attribute :date सँग बराबरको मिति हुनुपर्छ।',
  'date_format' => ':विशेषताले ढाँचा :format संग मेल खाँदैन।',
  'different' => ':attribute र :other फरक हुनुपर्छ।',
  'digits' => ':विशेषता :digits अंक हुनुपर्छ।',
  'digits_between' => ':विशेषता :min र :max अंकहरू बीच हुनुपर्छ।',
  'dimensions' => ':attribute मा अमान्य छवि आयामहरू छन्।',
  'distinct' => ':attribute फिल्डमा डुप्लिकेट मान छ।',
  'email' => ':attribute मान्य इमेल ठेगाना हुनुपर्छ।',
  'ends_with' => ':attribute निम्न मध्ये एउटासँग अन्त्य हुनुपर्छ: :values ।',
  'exists' => 'चयन गरिएको :attribute अमान्य छ।',
  'file' => ':attribute फाइल हुनुपर्छ।',
  'filled' => ':attribute फिल्डमा मान हुनुपर्छ।',
  'gt' => 
  array (
    'numeric' => ':attribute :value भन्दा ठुलो हुनुपर्छ।',
    'file' => ':attribute :value किलोबाइट भन्दा ठुलो हुनुपर्छ।',
    'string' => ':attribute :value वर्णहरू भन्दा ठुलो हुनुपर्छ।',
    'array' => ':attribute मा :value वस्तुहरू भन्दा बढी हुनुपर्छ।',
  ),
  'gte' => 
  array (
    'numeric' => ':attribute :value भन्दा ठूलो वा बराबर हुनुपर्छ।',
    'file' => ':attribute :value किलोबाइट भन्दा ठूलो वा बराबर हुनुपर्छ।',
    'string' => ':attribute :value अक्षरहरू भन्दा ठूलो वा बराबर हुनुपर्छ।',
    'array' => ':attribute :value वस्तुहरू वा थप हुनुपर्छ।
        ',
  ),
  'image' => ':attribute एउटा छवि हुनुपर्छ।',
  'in' => 'चयन गरिएको :attribute अमान्य छ।',
  'in_array' => ':attribute फिल्ड :other मा अवस्थित छैन।',
  'integer' => ':attribute पूर्णांक हुनुपर्छ।',
  'ip' => ':attribute मान्य IP ठेगाना हुनुपर्छ।',
  'ipv4' => ':attribute मान्य IPv4 ठेगाना हुनुपर्छ।',
  'ipv6' => ':attribute मान्य IPv6 ठेगाना हुनुपर्छ।',
  'json' => ':attribute एक मान्य JSON स्ट्रिङ हुनुपर्छ।',
  'lt' => 
  array (
    'numeric' => ':attribute :value भन्दा कम हुनुपर्छ।',
    'file' => ':attribute :value किलोबाइट भन्दा कम हुनुपर्छ।',
    'string' => ':attribute :value वर्णहरू भन्दा कम हुनुपर्छ।',
    'array' => ':attribute :value वस्तुहरू भन्दा कम हुनुपर्छ।
        ',
  ),
  'lte' => 
  array (
    'numeric' => ':attribute :value भन्दा कम वा बराबर हुनुपर्छ।',
    'file' => ':attribute :value किलोबाइट भन्दा कम वा बराबर हुनुपर्छ।',
    'string' => ':attribute :value वर्णहरू भन्दा कम वा बराबर हुनुपर्छ।',
    'array' => ':attribute मा :value वस्तुहरू भन्दा बढी हुनुहुँदैन।',
  ),
  'max' => 
  array (
    'numeric' => ':attribute :max भन्दा ठुलो हुनुहुँदैन।',
    'file' => ':attribute :max kilobytes भन्दा ठुलो हुनुहुँदैन।',
    'string' => ':attribute :max अक्षरहरू भन्दा ठुलो हुनुहुँदैन।.',
    'array' => ':attribute मा :max वस्तुहरू हुनुहुँदैन।',
  ),
  'mimes' => ':attribute प्रकारको फाइल हुनुपर्छ: :values ।',
  'mimetypes' => ':attribute प्रकारको फाइल हुनुपर्छ: :values ।',
  'multiple_of' => ':attribute :value को गुणन हुनुपर्छ।',
  'not_in' => 'चयन गरिएको :attribute अमान्य छ।',
  'not_regex' => ':attribute लप ढाँचा अमान्य छ।',
  'numeric' => ':attribute एउटा संख्या हुनुपर्छ।',
  'password' => 'पासवर्ड गलत छ।',
  'present' => ':attribute फिल्ड हुनु पर्छ।',
  'regex' => ':attribute को ढाँचा अमान्य छ।',
  'required_if' => ':attribute फिल्ड आवश्यक हुन्छ जब :other हुन्छ :value ।',
  'required_unless' => ':other :values मा नभएसम्म :attribute फिल्ड आवश्यक हुन्छ।',
  'required_with' => ':values उपस्थित हुँदा :attribute फिल्ड आवश्यक हुन्छ।',
  'required_with_all' => ':values उपस्थित हुँदा :attribute फिल्ड आवश्यक हुन्छ।',
  'required_without' => ':values नभएको बेला :attribute फिल्ड आवश्यक हुन्छ।',
  'required_without_all' => ':मानहरू मध्ये कुनै पनि नहुँदा :attribute क्षेत्र आवश्यक हुन्छ।',
  'prohibited' => ':attribute क्षेत्र निषेधित छ।',
  'prohibited_if' => ':attribute फिल्ड निषेध गरिएको छ जब :other हुन्छ :value।',
  'prohibited_unless' => ':attribute फिल्ड निषेधित छ जबसम्म :अन्य :values मा छैन।',
  'prohibits' => ':attribute फिल्डले :अन्यलाई उपस्थित हुनबाट रोक्छ।',
  'same' => ':attribute र :other मिल्नुपर्छ।',
  'size' => 
  array (
    'numeric' => ':attribute को आकार :size हुनुपर्छ।',
    'file' => ':attribute :size किलोबाइट हुनुपर्छ।',
    'string' => ':attribute :size अक्षरहरू हुनुपर्छ।',
    'array' => ':attribute मा :size वस्तुहरू समावेश हुनुपर्छ।',
  ),
  'starts_with' => ':attribute निम्न मध्ये एकबाट सुरु हुनुपर्छ: :values ।',
  'string' => ':attribute स्ट्रिङ हुनुपर्छ।',
  'timezone' => ':attribute मान्य समय क्षेत्र हुनुपर्छ।',
  'unique' => ':attribute पहिले नै लिइएको छ।',
  'uploaded' => ':attribute अपलोड गर्न असफल भयो।',
  'url' => ':attribute मान्य URL हुनुपर्छ।',
  'uuid' => ':attribute मान्य UUID हुनुपर्छ।',
  'custom' => 
  array (
    'attribute-name' => 
    array (
      'rule-name' => 'custom-message',
    ),
  ),
);
