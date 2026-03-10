## vitejs/plugin-legacy 支持低版本浏览器
- https://github.com/vitejs/vite/tree/main/packages/plugin-legacy
- https://segmentfault.com/q/1010000039923729
- https://blog.csdn.net/qq_42611074/article/details/123280584
- https://www.jianshu.com/p/f52b2073413e
- 修改配置文件`vite.config.ts`

		 plugins: [
		      legacy({
		        targets: ['chrome > 57', 'edge < 15'],
		        additionalLegacyPolyfills: ['regenerator-runtime/runtime'],
		         renderLegacyChunks:true,
		         polyfills:[
		            'es.symbol',
		            'es.array.filter',
		            'es.promise',
		            'es.promise.finally',
		            'es/map',
		            'es/set',
		            'es.array.for-each',
		            'es.object.define-properties',
		            'es.object.define-property',
		            'es.object.get-own-property-descriptor',
		            'es.object.get-own-property-descriptors',
		            'es.object.keys',
		            'es.object.to-string',
		            'web.dom-collections.for-each',
		            'esnext.global-this',
		            'esnext.string.match-all'
		        ]
		      })
			]