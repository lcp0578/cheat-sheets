## SM 国密算法
- 加密领域主要有国际算法和国密算法两种体系。国密算法是国家密码局认定的国产密码算法。国际算法是由美国安全局发布的算法。由于国密算法安全性高等一系列原因。国内的银行和支付机构都推荐使用国密算法。
- 国密与国际密对应关系
	<table>
		<tr>
			<th></th>
			<th>国密</th>	
			<th>国际密</th>
		</tr>
		<tr>
			<td>对称加密</td>	
			<td>SM1</td>	
			<td>AES（Advanced Encryption Standard）</td>
		</tr>
		<tr>		
			<td>非对称加密</td>	
			<td>SM2</td>	
			<td>RSA（Ron Rivest、Adi Shamir、Leonard Adleman）</td>	
		</tr>
		<tr>		
			<td>摘要算法（杂凑）</td>	
			<td>	SM3</td>	
			<td>	MD5（Message-Digest Algorithm）
SHA系列（Secure Hash Algorithm）</td>	
		</tr>
		<tr>
			<td>对称加密</td>	
			<td>	SM4</td>	
			<td>	DES（Data Encryption Standard）</td>	
		</tr>
	</table>
- SM1对称加密算法，分组长度为128位，密钥长度都为 128 比特，算法安全保密强度及相关软硬件实现性能与 AES 相当，算法不公开，仅以IP核的形式存在于芯片中。采用该算法已经研制了系列芯片、智能IC卡、智能密码钥匙、加密卡、加密机等安全产品，广泛应用于电子政务、电子商务及国民经济的各个应用领域（包括国家政务通、警务通等重要领域）。
- SM2为非对称加密，基于ECC。该算法已公开。由于该算法基于ECC，故其签名速度与秘钥生成速度都快于RSA。ECC 256位（SM2采用的就是ECC 256位的一种）安全强度比RSA 2048位高，且运算速度快于RSA。国家密码管理局公布的公钥算法，其加密强度为256位
- SM3 消息摘要。作用类似MD5/SHA系列。该算法已公开。
- SM4 对称加密算法。主要用于软件加密。

- https://blog.csdn.net/wang_jing_jing/article/details/121493025
- https://github.com/lpilp/phpsm2sm3sm4