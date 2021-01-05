<?php

namespace App\NepaliDate;

class conversion {

	private $nepali_length = array(
		1975 => array(31,32,31,32,31,30,30,30,29,30,29,31),
		1976 => array(31,32,31,32,31,30,30,30,29,29,30,30),
		1977 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		1978 => array(31,31,31,32,31,31,30,29,30,29,30,30),
		1979 => array(31,32,31,32,31,30,30,30,29,30,29,31),
		1980 => array(31,32,31,32,31,30,30,29,30,29,30,30),
		1981 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		1982 => array(31,31,31,32,31,31,29,30,30,29,30,30),
		1983 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		1984 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		1985 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		1986 => array(31,31,31,32,31,31,29,30,30,29,30,30),
		1987 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		1988 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		1989 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		1990 => array(31,31,31,32,31,31,29,30,30,29,29,31),
		1991 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		1992 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		1993 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		1994 => array(30,32,31,32,31,30,30,30,29,30,29,31),
		1995 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		1996 => array(31,31,32,32,31,30,29,30,30,29,30,30),
		1997 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		1998 => array(30,32,31,32,31,30,30,30,29,30,29,31),
		1999 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2000 => array(30,32,31,32,31,30,30,30,29,30,29,31),
		2001 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2002 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		2003 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2004 => array(30,32,31,32,31,30,30,30,29,30,29,31),
		2005 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2006 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		2007 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2008 => array(31,31,31,32,31,31,29,30,30,29,29,31),
		2009 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2010 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		2011 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2012 => array(31,31,31,32,31,31,29,30,30,29,30,30),
		2013 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2014 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		2015 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2016 => array(31,31,31,32,31,31,29,30,30,29,30,30),
		2017 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2018 => array(31,32,31,32,31,30,30,29,30,29,30,30),
		2019 => array(31,32,31,32,31,30,30,30,29,30,29,31),
		2020 => array(31,31,31,32,31,31,30,29,30,29,30,30),
		2021 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2022 => array(31,32,31,32,31,30,30,30,29,29,30,30),
		2023 => array(31,32,31,32,31,30,30,30,29,30,29,31),
		2024 => array(31,31,31,32,31,31,30,29,30,29,30,30),
		2025 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2026 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2027 => array(30,32,31,32,31,30,30,30,29,30,29,31),
		2028 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2029 => array(31,31,32,31,32,30,30,29,30,29,30,30),
		2030 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2031 => array(30,32,31,32,31,30,30,30,29,30,29,31),
		2032 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2033 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		2034 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2035 => array(30,32,31,32,31,31,29,30,30,29,29,31),
		2036 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2037 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		2038 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2039 => array(31,31,31,32,31,31,29,30,30,29,30,30),
		2040 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2041 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		2042 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2043 => array(31,31,31,32,31,31,29,30,30,29,30,30),
		2044 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2045 => array(31,32,31,32,31,30,30,29,30,29,30,30),
		2046 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2047 => array(31,31,31,32,31,31,30,29,30,29,30,30),
		2048 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2049 => array(31,32,31,32,31,30,30,30,29,29,30,30),
		2050 => array(31,32,31,32,31,30,30,30,29,30,29,31),
		2051 => array(31,31,31,32,31,31,30,29,30,29,30,30),
		2052 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2053 => array(31,32,31,32,31,30,30,30,29,29,30,30),
		2054 => array(31,32,31,32,31,30,30,30,29,30,29,31),
		2055 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2056 => array(31,31,32,31,32,30,30,29,30,29,30,30),
		2057 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2058 => array(30,32,31,32,31,30,30,30,29,30,29,31),
		2059 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2060 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		2061 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2062 => array(30,32,31,32,31,31,29,30,29,30,29,31),
		2063 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2064 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		2065 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2066 => array(31,31,31,32,31,31,29,30,30,29,29,31),
		2067 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2068 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		2069 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2070 => array(31,31,31,32,31,31,29,30,30,29,30,30),
		2071 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2072 => array(31,32,31,32,31,30,30,29,30,29,30,30),
		2073 => array(31,32,31,32,31,30,30,30,29,29,30,31),
		2074 => array(31,31,31,32,31,31,30,29,30,29,30,30),
		2075 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2076 => array(31,32,31,32,31,30,30,30,29,29,30,30),
		2077 => array(31,32,31,32,31,30,30,30,29,30,29,31),
		2078 => array(31,31,31,32,31,31,30,29,30,29,30,30),
		2079 => array(31,31,32,31,31,31,30,29,30,29,30,30),
		2080 => array(31,32,31,32,31,30,30,30,29,29,30,30),
		2081 => array(31,31,32,32,31,30,30,30,29,30,30,30),
		2082 => array(30,32,31,32,31,30,30,30,29,30,30,30),
		2083 => array(31,31,32,31,31,30,30,30,29,30,30,30),
		2084 => array(31,31,32,31,31,30,30,30,29,30,30,30),
		2085 => array(31,32,31,32,30,31,30,30,29,30,30,30),
		2086 => array(30,32,31,32,31,30,30,30,29,30,30,30),
		2087 => array(31,31,32,31,31,31,30,30,29,30,30,30),
		2088 => array(30,31,32,32,30,31,30,30,29,30,30,30),
		2089 => array(30,32,31,32,31,30,30,30,29,30,30,30),
		2090 => array(30,32,31,32,31,30,30,30,29,30,30,30),
		2091 => array(31,31,32,32,31,30,30,29,30,29,30,30),
		2092 => array(30,31,32,32,31,30,30,30,29,30,30,30),
		2093 => array(30,32,31,32,31,30,30,30,29,29,30,30),
		2094 => array(31,31,32,31,31,30,30,30,29,30,30,30),
		2095 => array(31,31,32,31,31,31,30,29,30,30,30,30)
	);

	private $firstday_en ="1918-04-13";
	private $start_ne = "1975";
	private $start_en = "1918";
	private $end_ne = "2095";
	private $end_en = "2038";
	private $month_name = array('बैशाख', 'जेठ', 'असार', 'साउन', 'भदौ', 'असोज', 'कार्तिक', 'मङ्सिर', 'पुस', 'माघ', 'फाल्गुण', 'चैत');
	private $day_name = array('आइतबार', 'सोमबार', 'मङ्गलबार', 'बुधबार', 'बिहिबार', 'शुक्रबार', 'शनिवार');

	private function get_week_ne($year, $month, $day)
	{
		 $jd = GregorianToJD($month, $day, $year);
		 return $this->day_name[JDDayOfWeek($jd,0)];
	}

	private function validate_ne($year, $month, $day)
	{
		if(!array_key_exists($year, $this->nepali_length))
		{
			return 'Invalid <b>Year</b> range';
		}
		if($month >12 || $month<1)
		{
			return 'Invalid <b>Month</b> range';
		}
		if($day>$this->nepali_length[$year][$month-1] || $day<1)
		{
			return 'Invalid <b>Day</b>';
		}
		return TRUE;
	}
	private function validate_en($year, $month, $day)
	{
		if ($year < $this->start_en || $year>$this->end_en) { return 'Invalid Year Range';}
		if ($month < 1 || $month>12) { return 'Invalid Month Range';}
		if ($day < 1 || ($day>cal_days_in_month(CAL_GREGORIAN, $month, $year)))
			{ return 'Invalid day Range';}
		return TRUE;
	}

	//Convert AD to Bs
	public function get_nepali_date($year,$month,$day)
	{
		$validate = $this->validate_en($year, $month, $day);
		if($validate !== TRUE)
			{
				die($validate);
			}

		$date = $year.'-'.$month.'-'.$day;
		$dayname = $this->get_week_ne($year, $month, $day);
		$date_start=date_create($this->firstday_en);
		$date_today=date_create($date);
		$diff=date_diff($date_start,$date_today, true);
		$days = $diff->format("%a");
		$arr='0';
		$mm='';
		for ($i=$this->start_ne; $i<$this->end_ne; $i++)
		{
			$arr+=array_sum($this->nepali_length[$i]);

			if ($arr>$days)
			{
				$year = $i;

				$count_previous=$arr-array_sum($this->nepali_length[$i]);
				$year_previous = $i-1;
				for ($j=0; $j < 12; $j++)
				{
					$count_previous+= $this->nepali_length[$i][$j];
					if($count_previous>$days)
					{
						$month = $j+1;
						$daysss = $count_previous-$days;
						$dayss = ($this->nepali_length[$i][$j]-$daysss)+1;
						break;
					} elseif ($count_previous==$days)
					{
						$year = $i;
						$month = $j+1;
						$day = 1;
					}
				}
				break;
			} elseif($arr==$days)
			{
				$year = $i+1;
				$month = 1;
				$day = 1;
			}
		}
		$date = array();
		$date['y'] = $year;
		$date['m'] = $month;
		$date['M'] = $this->month_name[$month-1];
		$date['d'] = $dayss;
		$date['l'] = $dayname;
		return $date;
	}


	//Convert Nepali Date to english
	public function get_eng_date($year, $month, $day)
	{
		$validate = $this->validate_ne($year, $month, $day);
		if($validate !== TRUE)
			{
				die($validate);
			}

		$date_start = date_create($this->firstday_en);
		$daycount = '0';
		$months=$month-1;
		for($i=$this->start_ne;$i<$year; $i++)
		{
			$daycount+=array_sum($this->nepali_length[$i]);
		}
		for($j=0; $j<$months; $j++)
		{
			$daycount+=$this->nepali_length[$i][$j];
		}
		$daycount+=$day-1;

		$nep = date_add($date_start, date_interval_create_from_date_string($daycount." days"));
		$date = array();
		$date['y'] = date_format($nep, "Y");
		$date['m'] = date_format($nep, "m");
		$date['M'] = date_format($nep, "M");
		$date['d'] = date_format($nep, "d");
		$date['l'] = date_format($nep, "l");
		return $date;
	}
//end of class
}

?>