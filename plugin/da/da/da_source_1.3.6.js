/***************** JS��������չ **************************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: JavaScript��������չ
	version: 1.0.0
*/
(function( win, undefined ){
	/***************** Number����չ *************************************/
	/**��ʽ��
	*@param {String} fmt ��ʾģ��
	*@example alert((1234567.12345678).format("#.##")); 
	*		  alert((1234567.12345678).format("#,##")); 
	*/
	Number.prototype.format = function( fmt ){
		fmt = fmt.toLowerCase();
		var res, haszero, hasflag, idx;
		
		if( haszero = 0 <= fmt.indexOf("0") ) fmt = fmt.replace("0", "");
		
		res = parseFloat(this,10);
		if ( 0 == this && haszero ) {
			return "&nbsp;";
		};
		
		idx = fmt.indexOf(".");
		if (idx < 0 ) {
			idx = fmt.indexOf(",");
			if (idx >= 0) {								//������"." ����, �Ҵ���"," ����
				hasflag = true;							//��ʾλ���ָ���
			}
		}
		
		if (idx >= 0) {									//��"."��","(�����Ա�ʾ����С��λ��)
			idx = fmt.substr(idx + 1).length;
		}
		else {											//"." ���ź�"," ���Ŷ�������
			idx = 0;
		}
		res = (Number(res)).toFixed(parseInt(idx,10));		//������С��λ������������
		
		if (hasflag) 
		{
			var arrTmp = [];
			idx = res.indexOf(".");
			
			if ((idx > 3) && (idx <= 6)) {
				arrTmp.push( res.substr(0, idx-3) );
				arrTmp.push( res.substr(idx-3) );
			}
			else if ((idx > 6) && (idx <= 9)) 
			{
				arrTmp.push( res.substr(0, idx-6) );
				arrTmp.push( res.substr(idx-6, 3) );
				arrTmp.push( res.substr(idx-3) );
			}
			else if ((idx > 9) && (idx <= 12)) 
			{
				arrTmp.push( res.substr(0, idx-9) );
				arrTmp.push( res.substr(idx-9, 3) );
				arrTmp.push( res.substr(idx-6, 3) );
				arrTmp.push( res.substr(idx-3) );
			}
			else if ((idx > 12)) 
			{
				arrTmp.push( res.substr(0, idx - 12) );
				arrTmp.push( res.substr(idx - 12, 3) );
				arrTmp.push( res.substr(idx-9, 3) );
				arrTmp.push( res.substr(idx-6, 3) );
				arrTmp.push( res.substr(idx-3) );
			};
			
			res = arrTmp.join(",");
		};
			
		return da.isNull( res, 0.00);
	};

	/***************** String����չ *************************************/
	/**ȥǰ��ո�
	*/
	String.prototype.trim = function(){
		return this.replace(/(^\s+)|(\s+$)/g, "");
	};
	
	/**ȥ��ͷ�ո�
	*/
	String.prototype.trimLeft = function(){
		return this.replace(/^\s+/g, "");
	};
	
	/**ȥ��β�ո�
	*/
	String.prototype.trimRight = function(){
		return this.replace(/\s+$/g, "");
	};
	
	/**ȥ���пո�
	*/
	String.prototype.trimAll = function(){
		return this.replace(/\s/g, "");
	};

	/**����
	*/
	String.prototype.toHex = function(){
		return da.toHex(this);
	};
	
	/**����
	*/
	String.prototype.toStr = function(){
		return  da.toStr(this);
	};
	/***************** Date����չ *************************************/
	/**��ʽ��
	*@param {String} fmt ��ʾģ��
	*@example alert(new Date().format("yyyy-MM-dd")); 
	*		  alert(new Date("january 12 2008 11:12:30").format("yyyy-MM-dd hh:mm:ss")); 
	*/
	Date.prototype.format= function( fmt ){
		if(/(y+)/.test(fmt))											//��
		fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length)); 

		var o = { 
			"m+" : this.getMonth()+1, 									//�� 
			"d+" : this.getDate(),    									//��
			"h+" : this.getHours(),   									//ʱ 
			"n+" : this.getMinutes(), 									//�� 
			"s+" : this.getSeconds(), 									//�� 
			"q+" : Math.floor((this.getMonth()+3)/3),					//�� 
			"i" : this.getMilliseconds() 								//���� 
		};

		for(var k in o){
			if(new RegExp("("+ k +")").test(fmt)) 
				fmt = fmt.replace(RegExp.$1, RegExp.$1.length==1 ? o[k] : ("00"+ o[k]).substr((""+ o[k]).length)); 
		}
		return fmt; 
	};
	
	/***************** Array����չ *************************************/
	/**��ǰ��� �����״�ƥ���Ա������ֵ
	*/
	Array.prototype.indexOf = function( item, i, step ){
		i = i || 0;												//��ʼ����ʼ�±�(��Ҫ����0) �Ͳ���
		step = step || 1;
		
		for (; i<this.length; i+=step)
			if (this[i] === item) return i; 					//ʹ��"==="(ȫ����)�жϷ���Object���������޷�����ƥ�䣬���غ�Ϊfalse
			
		return -1;
	};
	
	/**�Ӻ���ǰ �����״�ƥ���Ա������ֵ
	*/
	Array.prototype.lastIndexOf = function( item, i, step ){
		i = i || this.length-1; 										//��ʼ����ʼ�±� �Ͳ���
		step = step || 1;
		
		for (; i>0; i-=step)
			if (this[i] === item) return i; 							//ʹ��"==="(ȫ����)�жϷ���Object���������޷�����ƥ�䣬���غ�Ϊfalse
			
		return -1;
	};

	/**��ȡָ��λ�úͳ�������
	* �磺arr.get(0,5); 		//��ͷ���ȡ5������
		  arr.get(-1,5); 		//�Ӻ���ǰȡ5������
		  arr.get("item3",3); 	//��ֵΪ"item3"������,���ȡ2������(����ֵΪ"item3"������)
		  arr.get(2)			//ȡ����2֮�����������(����2)
	*/
	Array.prototype.get = function( i, len ){
		var start, end;
		start = ( undefined === i ? 0 : i );
		
		if( "number" !== typeof start ){		//��Ҫͨ������ƥ���ҵ���Ӧ����
			start = this.indexOf( start );
		}
		
		if( undefined !== len ){
			len = Math.abs(len);
			end = ( 0 > start ? start-len : start+len );
		}
		return this.slice( start, end );
	};
	
	/**�Ƴ�ָ��λ�úͳ�������
	* �磺arr.remove(2) == arr.remove(2,1); 
	*/
	Array.prototype.remove = function( i, len ){						
		if( undefined === i ) return this;
		len = len || 1;
		
		if( "number" !== typeof i ){			//��Ҫͨ������ƥ���ҵ���Ӧ����
			i = this.indexOf( i );
		}
		
		return this.splice( i, len );			//�Ƴ�����������
	};
	
	/**�����������ָ��λ��(ǰ)
	* �磺[1,2,3].insert(2,"1.5","1.6");	["a","b","c"].insert("c",["b1","b2","b3"]);
	*/
	Array.prototype.insert = function( /*i, [item1], [item1], ..., [item1]*/ ){
		if( 2 > arguments.length ) return this;
		var i = arguments[0],
			arrItem = this.slice.call( arguments, 1 );			//�޳���һ������
		
		if( "number" !== typeof i ){							//��Ҫͨ������ƥ���ҵ���Ӧ����
			i = this.indexOf( i );
			if( 0 > i ){
				i = this.length;
			}
		}
		
		arrItem = [ i, 0 ].concat( arrItem );
		this.splice.apply( this, arrItem );						//��������
		
		return this;
	};
	
	/**׷���������ָ��λ��(��)
	* �磺[1,2,3].append(1,"1.5","1.6");	["a","b","c"].append("b",["b1","b2","b3"]);
	*/
	Array.prototype.append = function( /*i, [item1], [item1], ..., [item1]*/ ){
		if( 2 > arguments.length ) return this;
		var i = arguments[0],
			arrItem = this.slice.call( arguments, 1 );			//�޳���һ������
		
		if( "number" !== typeof i ){							//��Ҫͨ������ƥ���ҵ���Ӧ����
			i = this.indexOf( i );
			if( 0 > i ){
				i = this.length;
			}
		}
		i++;													//׷����������+1
		arrItem = [i,0].concat( arrItem );
		this.splice.apply( this, arrItem );						//��������
		
		return this;
	};
	
	/**�滻����ָ����
	* �磺[1,2,3].replace(1,"1.5","1.6");	["a","b","c"].replace("b",["b1","b2","b3"]);
	*/
	Array.prototype.replace = function( /*i, [item1], [item1], ..., [item1]*/ ){
		if( 2 > arguments.length ) return this;
		var i = arguments[0],
			arrItem = this.slice.call( arguments, 1 );			//�޳���һ������
		
		if( "number" !== typeof i ){							//��Ҫͨ������ƥ���ҵ���Ӧ����
			i = this.indexOf( i );
		}
		if( 0 > i || this.length <= i ){
			return this;
		}
		
		arrItem = [i,1].concat( arrItem );
		this.splice.apply( this, arrItem );						//��������
		
		return this;
	};
	
	/**����һ������ϲ���ָ��λ��(ǰ)
	* �磺[1,2,3].marge(1, ["a","b","c"]);	["a","b","c"].marge("a","b");
	*/
	Array.prototype.marge = function( i, arr ){
		if( 2 > arguments.length ) return this;
		
		if( !da.isArray( arr ) ){											//������
			return this.append( i, arr );
		}
		i = ( undefined !== i ? 0 > i ? 0 : i : this.length ); 				//��������
		
		return this.slice( 0, i ).concat(arr).concat( this.slice( i ) );	 
	};

})(window);

/***************** daǰ̨javascript�����ű��� **************************/
/*
	author:	danny.xu
	date: 2012.5.14
	description: daǰ̨javascript�����ű���
	version: 1.3.5
*/
(function( win ){
	var doc = win.document;
	
	var da = (function() {
		/**da�๹�캯��
		*/
		var da = function( obj, context ){				//ͨ���ֲ�������ʵ�ֹ��캯������������ͬ
			return new da.fnStruct.init( obj, context, daDoc );
		},
		
		daDoc,											//Ŀ�괰��Document��������Ӧ��da����
		
		// The deferred used on DOM ready
		readyList = [],									//�ص������б�(֧�ֶ��ready�����ĵ���)
		readyBound = false,								//�ж��Ƿ��Ѿ���ready�¼�����
		// The ready event handler
		DOMContentLoaded,
		
		daRe_quickExpr = /^(?:[^<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,		//��֤�Ƿ��ǵ�����HTML�ַ���,����Ԫ��idѡ�������磺"#myid"
		
		daRe_notwhite = /\S/,											//��֤�ַ����Ƿ��пո�
		daRe_white = /\s/,
		
		daRe_trimLeft = /^\s+/,											//��֤�ַ��������Ƿ��пո�
		daRe_trimRight = /\s+$/,

		daRe_singleTag = /^<(\w+)\s*\/?>(?:<\/\1>)?$/,					//ƥ����֤һ��Ԫ�ؽڵ�

		daRe_validchars = /^[\],:{}\s]*$/,								// JSON ������
		daRe_validescape = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,
		daRe_validtokens = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
		daRe_validbraces = /(?:^|:|,)(?:\s*\[)+/g,

		daRe_dashAlpha = /-([a-z]|[0-9])/ig,
		daRe_msPrefix = /^-ms-/,

		_daToString = Object.prototype.toString,					//��������ת�ַ���	//ͨ�����ַ�ʽ�жϣ� "[object Array]" == _daToString.call(objDOM)
		_daHasOwnProperty = Object.prototype.hasOwnProperty,		//�ж϶����Ƿ�ӵ��XX���� //ͨ�����ַ�ʽ�жϣ� _daHasOwnProperty.call(obj, "constructor")
		_daTrim = String.prototype.trim,							//ȥ�ַ���ǰ��ո�
		_daIndexOf = Array.prototype.indexOf,						//������ƥ��������ѯ����
		_daSlice = Array.prototype.slice,							//��ȡ��������
		_daPush = Array.prototype.push,								//ѹ�������

		fcamelCase = function( all, letter ) {						//�������շ��ʽ��
			return ( letter + "" ).toUpperCase();
		},
		
		class2type = {};											//��������ӳ���
		
		//da�����Լ�
		da.fnStruct = da.prototype = {
			version: "da libary 1.3.5; author: danny.xu; date: 2012.5.14",
			
			dom: [],					//������������
			length:	0,					//�����������
			selecter: "",				//ΪSizzle.js������ѡ�����ַ���
			
			constructor: da,

			//��ʼ������
			init: function( selector, context, daDoc ) {
				var match, elem, ret, docTmp;
				this.dom = [];							//ע��danny.xu ����Ҫ�ȳ�ʼ��һ��
				
				if ( !selector ) return this;			//�пմ���ֱ�ӷ��ص�ǰda�ն���, �� da(""), da(null), or da(undefined)
				
				if ( selector.nodeType ) {						//���ֱ�Ӵ���DOMԪ�ض����� da(ElementObject)
					this.context = this.dom[0] = selector;		//��da����Ԫ�ض��������������ΪDOMԪ�ض���
					this.length = 1;
					return this;
				}
		
				if ( selector === "body" && !context && doc.body ) {	//��ΪbodyԪ��ֻ��һ�����������⴦��һ�£��Ż�����
					this.context = doc;
					this.dom[0] = doc.body;
					this.selector = selector;
					this.length = 1;
					return this;
				}

				if ( typeof selector === "string" ) {					//��������selector���ַ�������Ҫ�õ�Sizzleѡ����
					// Are we dealing with HTML string or an ID?
					if ( selector.charAt(0) === "<" 
					&& selector.charAt( selector.length - 1 ) === ">" 
					&& selector.length >= 3 ) {
						match = [ null, selector, null ];				//���obj��"<>"��ͷ��β��˵����HTML���룬����ֱ������Ԫ��ѡ��������֤
					}
					else {
						match = daRe_quickExpr.exec( selector );		//�ж��Ƿ���#idѡ����
					}
		
					if ( match && (match[1] || !context) ) {			//context����Ϊ��
						if ( match[1] ) {								//�����selector����#idѡ��������HTML����Ƭ�Σ��� da(html)
							context = context instanceof da ? context.dom[0] : context;
							docTmp = (context ? context.ownerDocument || context : doc);
		
							ret = daRe_singleTag.exec( selector );				//����������һ��Ԫ�ص�HTML,˵��ֻ�ǵ����Ĵ���һ��Ԫ��
		
							if ( ret ) {										//��������Ԫ��
								if ( da.isPlainObj( context ) ) {				//���������ֵ����ͨ��attr��������
									selector = [ doc.createElement( ret[1] ) ];
									da.fn.attr.call( selector, context, true );
		
								}
								else {																								
									selector = [ docTmp.createElement( ret[1] ) ];
								}
		
							}
							else {												//��Ҫ�����Ĳ�ֹһ��Ԫ�أ���Ҫ�����ĵ�Ƭ��
								ret = da.buildFragment( [ match[1] ], [ docTmp ] );
								selector = (ret.cacheAble ? da.clone(ret.fragment) : ret.fragment).childNodes;	//������Ի����������ĵ�Ƭ�Σ��Ϳ�¡һ�·��أ�����Ӱ�컺����ĵ�Ƭ��
							}
		
							return da( da.merge( this.dom, selector ));			//�ϲ�Ԫ�ؼ�������
		
						} 
						else {											//�����selector��Ԫ��#idѡ�������磺"#myid"
							elem = doc.getElementById( match[2] );
		
							if ( elem && elem.parentNode ) {					// Check parentNode to catch when Blackberry 4.6 returns nodes that are no longer in the document #6963
								if ( elem.id !== match[2] ) {					// Handle the case where IE and Opera return items by name instead of ID
									return daDoc.find( selector );
								}
		
								// Otherwise, we inject the element directly into the jQuery object
								this.length = 1;
								this.dom[0] = elem;
							}
		
							this.context = doc;
							this.selector = selector;
							return this;
						}
		
					}
					else if ( !context || context instanceof da ) {		//context������da������ da(expr, da(...))
						return (context || daDoc).find( selector );
		
					}
					else {												//context������ѡ���� ��DOM������ da(expr, "#m_parent"), da(expr, m_parent)
						return this.constructor( context ).find( selector );
					}
		
				}
				else if ( da.isFunction( selector ) ) {					//��������selector��Function��˵����Ҫ��Document������ϻص�����
					return daDoc.ready( selector );
				}
		
				if (selector.selector !== undefined) {
					this.selector = selector.selector;
					this.context = selector.context;
				}
				
				da.pushArray( selector, this.dom );
				
				return this;
			},
			
			/**ͨ��slice������da����תΪDOM��������
			*/
			toArray: function() {
				return _daSlice.call( this.dom, 0 );
			},
			
			/**��������ֵ���da�����е�DOM
			* @param {Int} num Ŀ��dom���������е�����ֵ��Ϊ�շ�������DOM����
			*/
			get: function( num ) {
				return num == null ?
					this.toArray() :				// Return a 'clean' array
					( num < 0 ? this.dom[ this.dom.length + num ] : this.dom[ num ] );	// Return just the object
			},	

			//��Ԫ�ؼ���ѹΪһ��ȫ�µ�da����
			/*
				elems: Ԫ�ؼ���
				name: ������
				selector: ȫ�µ�ѡ�����ַ���
			*/
			pushStack: function( elems, name, selector ) {
				var ret = this.constructor();				//����newһ��ȫ�µĿ�da����
		
				if ( da.isArray( elems ) ) {
					_daPush.apply( ret.dom, elems );
				} 
				else {
					da.merge( ret.dom, elems );
				}
		
				ret.prevObject = this;						//����ǰһ��da����ĵ�ַ��ʵ�ֶ�ջ/����Ĺ���
				ret.context = this.context;
		
				if ( name === "find" ) {					//ѡ�����ַ�������
					ret.selector = [ this.selector, (this.selector ? " " : ""), selector ].join("");
				} 
				else if ( name ) {
					ret.selector = [ this.selector, ".", name, "(", selector, ")" ].join("");
				}
		
				return ret;									//����ȫ�µ�da����
			},
			
			//��������������
			/*
				fn:	����ص�����( ����˺�������Ϊ false, ������ֹ���������ļ���ִ�� )
				arg: �˲���ֻ���ű����ڲ�ʹ��( ����ֱ�Ӵ�����ú��� ��ǰ��arguments )
			*/
			each: function( fn, args ) {
				da.each( this.dom, fn, args );
				return this;								//����da����ʵ�ִ�����
			},
			
			//�������ӳ�������
			/*
				fn:	�ص����˺���
			*/
			map: function( fn ) {
				return this.pushStack( da.map(this.dom, function( obj, i ) {
					return fn( obj, i );
				}));
			},
			
			ready: function( fn ) {
				da.bindReady();
				if ( da.isReady ) {				//���document�Ѿ��������
					fn.call( doc, da );			//�����ص�����
				}
				else if ( readyList ) {			//���û�м�����ϣ����ص�����ѹ��ȫ���б�
					readyList.push( fn );
				}
				return this;
			}
		};
		//����̳�da������
		da.fnStruct.init.prototype = da.fnStruct;
		
		//������չ�������������ء��ϲ�������
		/*
			dest : �����չĿ��
			src1,src2,src3...srcN	:	��չ���ݼ�ֵ�ԣ����أ�ͬ��ֵ�Ḳ�ǣ�
		*/
		da.extend = da.fnStruct.extend = function(/* dest,src1,src2,src3...srcN */) {
				var target = arguments[0] || {},
						i = 1,
						length = arguments.length,
						deep = false,
						options = null,
						name = null,
						src = null, 
						copy = null;
				
				if ( typeof target === "boolean" ) {				//�ж��Ƿ���Ҫ�����չ�ϲ��������չ�ϲ�ֻ����һ��Դ��
					deep = target;
					target = arguments[1] || {};
					i = 2;
				}
			
				if ( typeof target !== "object") {					//�����չ�ϲ���Ҫ ���ϵ���������
					target = {};
				}
			
				if ( length === i ) {												//�����չ����һ��Ŀ�����Ϊboolean�� �� ���ö���������չ��ֻ��һ��������ΪԴ������
					target = this;
					--i;
				}
			
				for ( ; i < length; i++ ) {
					if ( (options = arguments[ i ]) != null ) {			//��ȡ Դ�������
						for ( name in options ) {											//��ȡ Դ�����е�����
							src = target[ name ];						//��չĿ����� ��������
							copy = options[ name ];					//Դ���� ��������
			
							if ( target === copy ) {				//Դ���� === ��չĿ����󣨾���һģһ���Ķ��󣬲�������չ����չ����ֱ������
								continue;
							}
							
							//�����Ƕ�׼�ֵ�Զ�����ά���飬�����������չ
							if ( deep && copy && ( da.isPlainObj(copy) || da.isArray(copy) ) ) {
								var clone = src && ( da.isPlainObj(src) || da.isArray(src) ) ? src : da.isArray(copy) ? [] : {};
			
								//������չ
								target[ name ] = da.extend( deep, clone, copy );
			
							//û����Ƕ�׼�ֵ�Զ�����ά���飬���߲����������չ
							}
							else if ( copy !== undefined ) {
								target[ name ] = copy;
							}
						}
					}
				}
			
				//������չ��Ķ���
				return target;
		};


		//da�ྲ̬��Ա
		da.extend({
			isReady: false,			//ȷ��document�Ƿ����ʹ�ã������������Ϊtrue
			readyWait: 1,				//ready�ص������ļ�����

			//��ready����
			bindReady: function() {
				if ( readyBound ) {
					return;
				}
			
				readyBound = true;		//�״ΰ�ready�¼�����
			
				//�������ready�¼�������$(document).ready()����
				if ( doc.readyState === "complete" ) {
					return setTimeout( da.ready, 1 );			//�첽����
				}
				
				if ( document.addEventListener ) {						//����W3C�¼���
					document.addEventListener( "DOMContentLoaded", DOMContentLoaded, false );				//ȷ����onload�¼�֮ǰ����
					window.addEventListener( "load", da.ready, false );														//��window.onload�ص�������¼�����һֱ���ڵ�
			
				}
				else if ( document.attachEvent ) {						//����IE
					document.attachEvent("onreadystatechange", DOMContentLoaded);
					window.attachEvent( "onload", da.ready );
			
					var toplevel = false;									//�����IE����û�п�ܽṹ���������document�Ƿ��Ѿ��������
					try {
						toplevel = ( window.frameElement == null );
					} catch(e) {}
			
					if ( document.documentElement.doScroll && toplevel ) {
						doScrollCheck();
					}
				}
				
			},
			//DOM���������ϴ�����
			ready: function( wait ) {
				// A third-party is pushing the ready event forwards
				if ( wait === true ) {
					da.readyWait--;
				}
			
				//���DOM����û�м������
				if ( !da.readyWait || (wait !== true && !da.isReady) ) {
					if ( !doc.body ) {								//�ж�body����
						return setTimeout( da.ready, 1 );			//���þ�̬ready����
					}
					
					da.isReady = true;								//����document״̬Ϊ����
					
					if ( wait !== true && ( --da.readyWait > 0 ) ) {		//���һ��document��ready�¼���������da.readyWait�ݼ�����ֱ�ӷ���
						return;
					}
			
					if ( readyList ) {								//����а󶨻ص���������ִ�лص������б�
						var fn,
							i = 0,
							ready = readyList;
		
						readyList = null;						//�ÿջص������б�
			
						while ( (fn = ready[ i++ ]) ) {
							fn.call( doc, da );
						}
			
						// Trigger any bound ready events
						if ( da.fnStruct.trigger ) {
							da( doc ).trigger( "ready" );
							da( doc ).unbind( "ready" );
						}
					}
				}
			},
			
			//�պ���
			noop: function() {},
			//ʱ���ID
			nowId: function(){
				return (new Date).getTime();
			},
			
			//��ȡ��������(Сд)
			/*
				obj: Ŀ�����
			*/
			type: function( obj ) {
				return obj == null ?
				String( obj ) :
				class2type[ _daToString.call(obj) ] || "object";
			},
			//�ж��Ƿ���Window����
			/*
				obj: �ж�Ŀ�����
			*/
			// See test/unit/core.js for details concerning isFunction.
			// Since version 1.3, DOM methods and functions like alert
			// aren't supported. They return false on IE (#2968).
			isWin: function( obj ) {
				return obj && typeof obj === "object" && "setInterval" in obj;
			},
			
			//�ж��Ƿ���Document����
			/*
				obj: �ж�Ŀ�����
			*/
			isDoc: function( obj ) {
				return obj.nodeType === 9;
			},
			
			//�ж��Ƿ���Function����
			/*
				obj: �ж�Ŀ�����
			*/
			isFunction: function( obj ) {
				return _daToString.call(obj) === "[object Function]";
			},
		
			//�ж��Ƿ����������
			/*
				obj: �ж�Ŀ�����
			*/
			isArray: Array.isArray || function( obj ) {
				return _daToString.call(obj) === "[object Array]";
			},
		
			//�ж��Ƿ��Ǽ�ֵ�Զ���
			/*
				obj: �ж�Ŀ�����
			*/
			isPlainObj: function( obj ) {
				// Must be an Object.
				// Because of IE, we also have to check the presence of the constructor property.
				// Make sure that DOM nodes and window objects don't pass through, as well
				if ( !obj || _daToString.call(obj) !== "[object Object]" || obj.nodeType || obj.setInterval ) {
					return false;
				}
				
				// Not own constructor property must be Object
				if ( obj.constructor
					&& !_daHasOwnProperty.call(obj, "constructor")
					&& !_daHasOwnProperty.call(obj.constructor.prototype, "isPrototypeOf") ) {
					return false;
				}
				
				// Own properties are enumerated firstly, so to speed up,
				// if last one is own, then all properties are own.
			
				var key;
				for ( key in obj ) {}
				
				return key === undefined || _daHasOwnProperty.call( obj, key );
			},

			//�ж��Ƿ�����ֵ����
			isNumeric: function( obj ) {
				return !isNaN( parseFloat(obj) ) && isFinite( obj );
			},

			//�ж��Ƿ��ǿռ�ֵ�Զ���
			/*
				obj: �ж�Ŀ�����
			*/
			isEmptyObj: function( obj ) {
				for ( var name in obj ) {
					return false;
				}
				return true;
			},
			
			//��ֵ�ж�
			/*
				obj1: �пն������
				obj2: obj1Ϊ���������
			*/
			isNull: function( obj1, obj2 ){
				 var isError = false;
				 
			   if (( undefined === obj1 )
			   || ( null === obj1 ) 
			   || ( "undefined" === obj1 ) 
			   || ( "number" === typeof obj1 && da.isNaN( obj1 ) ) 
			   || ( "Infinity" === obj1 ) 
			   || ( "&nbsp;" === obj1 ) 
			   || ( "&#160;"=== obj1 ) 
			   || ( "" === obj1 )
			   || ( String.fromCharCode( 160 ) === obj1 ) )
						isError = true;
				
				if( 2 > arguments.length ){										//ֻ����һ��������ֻ���Ƿ�Ϊ���ж�
					return isError;
				}
				else{																					//����������������
					return isError ? obj2 : obj1;								//�ж�Ϊ��ʱ�����صڶ�������ֵ��obj2�������Ϊ��Чֵʱ������ԭֵ��obj1��
					
				}
			},
			
			//��Ч��ֵ�ж�
			/*
				obj: �ж϶���
			*/
			isNaN: function( obj ) {
				return obj == null || !/\d/.test( obj ) || isNaN( obj );
			},
				
			//Ԫ���������ж�
			/*
				elem: Ԫ�ض���
				name: Ҫ�жϵ�Ԫ��������
			*/
			isNodeName: function( elem, name ) {
				return elem.nodeName && elem.nodeName.toUpperCase() === name.toUpperCase();
			},
			
			/**ȡ��һ����Чֵ
			*/
			firstValue: function( /*obj1,obj2,[ obj3,obj4,��,objN ]*/ ){
				var val;
				
				for( var i=0,len=arguments.length; i<len; i++) {
					val = arguments[i];
					
					if( null !== da.isNull( val, null ) )
						return val;
					
				}
				
			},
			
			
			//�ж�Ԫ���������ڵ�λ��
			/*
				elem: Ԫ�ض���
				array: �������
			*/
			isInArray: function( elem, array ) {
				if ( _daIndexOf ) return _daIndexOf.call( array, elem );
		
				return array.indexOf( elem );
			},		
			//ѹΪ����( ׷�� )
			/*
				srcObj: ѹΪ�����Ŀ�����
				retArray:	�½����ػ������������
			*/
			pushArray: function( srcObj, retArray ){
					retArray = retArray || [];
					if ( srcObj != null ) {
							var typeObj = da.type( srcObj );
							
							// The extra typeof function check is to prevent crashes
							if ( null == srcObj.length 																			//��Ϊwindow, strings, functions Ҳ��"length"����
								|| "string" === typeObj 																			//string ����
								|| "function" === typeObj 																		//function ����
								|| "regexp" === typeObj 																			//Regexp ����		// Tweaked logic slightly to handle Blackberry 4.7 RegExp issues
								|| da.isWin( srcObj ) ) {																			//window ����
								retArray.push( srcObj );																			//ֱ�ӰѶ���ѹ������
								
							}
							else {
								da.merge( retArray, srcObj );																	//�ϲ���������
							
							}
					}
					
					return retArray;
			},
			//�ϲ���������
			/*
				first: ��һ������
				second: �ڶ�������
			*/
			merge: function( first, second ) {
				var i = first.length,
						j = 0;
		
				if ( "number" === typeof second.length ) {						//��׼���������ͣ�ӵ��length����
					for ( var l = second.length; j < l; j++ ) {
						first[ i++ ] = second[ j ];
					}
		
				}
				else {																								//�������͵����飬����û��length����
					while ( undefined !== second[j] ) {
						first[ i++ ] = second[ j++ ];
					}
				}
		
				first.length = i;
		
				return first;
			},
		
			/**�������շ��ʽ������
			*/
			camelCase: function( string ) {
				return string.replace( daRe_msPrefix, "ms-" ).replace( daRe_dashAlpha, fcamelCase );
			},
			//��������������
			/*
				objs: ������Ŀ�����
				fn:	����ص�����( ����˺�������Ϊ false, ������ֹ���������ļ���ִ�� )
				arg: �˲���ֻ���ű����ڲ�ʹ��
			*/
			each: function( objs, fn, args ) {
					var name,
						i = 0,
						length = objs.length,
						isObj = ( length === undefined ) || da.isFunction(objs);
			
					if( args ) {
							if ( isObj ) {						//��������
									for ( name in objs ) {
											if ( fn.apply( objs[ name ], args ) === false ) {
												break;
											}
									}
							}
							else {										//������
									for ( ; i < length; ) {
											if ( fn.apply( objs[ i++ ], args ) === false ) {
												break;
											}
									}
							}
			
					} else{
							if ( isObj ) {						//��������
									for( name in objs ) {
											if ( fn.call( objs[ name ], name, objs[ name ] ) === false ) {
												break;
											}
									}
							}
							else{											//������
									for( var value=objs[0]; i<length && ( fn.call( value, i, value ) !== false ); value=objs[++i] ) {}
							}
					}
			
					return objs;
			},

			//����֤���������ز�����������Ԫ�ؼ��Ϻ���
			/*
				elems: ��Ҫ����֤�����Ԫ�ؼ���
				callback: ����֤����ص�����
				inv: ��֤���ƥ��boolֵ
			*/
			grep: function( elems, callback, inv ) {
				inv = !!inv;
				
				var ret = [], retVal;
		
				for ( var i=0, len=elems.length; i < len; i++ ) {
					retVal = !!callback( elems[ i ], i );										//ѭ��������ͨ�������û��Զ�����֤���������õ���֤����ֵ
					
					if ( inv !== retVal ) {																	//�����֤��������ϣ��������ϵ�Ԫ��ѹ�����飬������Ϸ��ظ�����
						ret.push( elems[ i ] );
					}
				}
		
				return ret;
			},

			//�������ӳ�������
			/*
				objs: Ŀ���������
				fn:	�ص����˺���
				arg: �˲���ֻ���ű����ڲ�ʹ��
			*/
			map: function( objs, fn, arg ) {
				var retArray = [], 
					value = null;

				for ( var i = 0, length = objs.length; i < length; i++ ) {				//ѭ��Ŀ���������ͨ�����ù��˺��������յõ����˺����Ч����
					value = fn( objs[ i ], i, arg );

					if ( value != null ) {
							//retArray[ retArray.length ] = value;
							retArray.push( value );
					}
				}
				return retArray.concat.apply( [], retArray );
				
			},
			
			guid: 1,				//ȫ��Ψһ��ʶ��
			
			//������
			/*
				fn: Դ������ص�����
				proxy: ������ص�����
				thisObject: 
			*/
			proxy: function( fn, proxy, thisObject ) {
				if ( arguments.length === 2 ) {
					if ( typeof proxy === "string" ) {							//��������ֵ�ԣ�proxy( {click:function(){},dbclick:function(){}}, "click" )
						thisObject = fn;
						fn = thisObject[ proxy ];
						proxy = undefined;
		
					}
					else if ( proxy && !da.isFunction( proxy ) ) {	//
						thisObject = proxy;
						proxy = undefined;
					}
				}
		
				if ( !proxy && fn ) {							//
					proxy = function() {								
						return fn.apply( thisObject || this, arguments );
					};
				}
		
				// Set the guid of unique handler to the same of original handler, so it can be removed
				if ( fn ) {
					proxy.guid = fn.guid = fn.guid || proxy.guid || da.guid++;
				}
		
				// So proxy can be declared as an argument
				return proxy;
			},

			//���������ж���� ����
			/*
				elems: DOM�ڵ��������
				key: ������( ������ ��ֵ�Եķ�ʽset�������ֵ)
				value: ����ֵ( �����Ǻ�������ʽ, function(index, value){}, ����ֵΪ�������㷵��ֵ)
				exec:	������ֵ������Ϊfunctionʱ,������֮ǰ��valueִֵ�к���( Ĭ��Ϊtrue )
				fn:	
				pass: �Ƿ�ͨ��da�����Ӧ ��Ա��������������ֵ
			*/
			access: function( elems, fn, key, value, chainable, emptyGet, pass  ) {
				var exec,
					bulk = key == null,
					i = 0,
					length = elems.dom.length;

				//set�������
				if ( key && typeof key === "object" ) {							//��keyֵ������Ϊobjectʱ������value��key,value��ʽ�ٴεݹ鴫��da.access
					for ( i in key ) {
						da.access( elems, fn, i, key[i], 1, emptyGet, value );
					}
					chainable = 1;

				
				} //set��һ����
				else if ( value !== undefined ) {
					// Optionally, function values get executed if exec is true
					exec = pass === undefined && da.isFunction( value );		//�ж�����ֵ�Ƿ����Ժ�������ʽ�ļ�����

					if ( bulk ) {
						// Bulk operations only iterate when executing function values
						if ( exec ) {
							exec = fn;
							fn = function( elem, key, value ) {
								return exec.call( da( elem ), value );
							};

						// Otherwise they run against the entire set
						} else {
							fn.call( elems, value );
							fn = null;
						}
					}

					if ( fn ) {
						for (; i < length; i++ ) {
							fn( elems.dom[i], key, exec ? value.call( elems.dom[i], i, fn( elems.dom[i], key ) ) : value, pass );
						}
					}

					chainable = 1;
				}

				//get����ֵ
				return chainable ?
					elems :
					// Gets
					bulk ?
						fn.call( elems ) :
						length ? fn( elems.dom[0], key ) : emptyGet;
			},
			
			//�����׳��쳣
			error: function( msg ) {
				throw new Error( msg );
			},
			
			//ȥ���ַ���ǰ��ո�
			trim: ( _daTrim ?
			function( text ) {
				return text == null ? "" : _daTrim.call( text );
			} :
			// Otherwise use our own trimming functionality
			function( text ) {
				return text == null ? "" : text.toString().replace( daRe_trimLeft, "" ).replace( daRe_trimRight, "" );
			}),
			
			//ǿ��תΪJSON����
			/*
				data: ת��Ŀ������
			*/
			parseJSON: function( data ) {
					if ( typeof data !== "string" || !data ) {
						return null;
					}
			
					// Make sure leading/trailing whitespace is removed (IE can't handle it)
					data = da.trim( data );
					
					// Make sure the incoming data is actual JSON
					// Logic borrowed from http://json.org/json2.js
					if ( daRe_validchars.test( data.replace(daRe_validescape, "@").replace(daRe_validtokens, "]").replace(daRe_validbraces, "") ) ) {
						// Try to use the native JSON parser first

						return ( window.JSON && window.JSON.parse ) ? window.JSON.parse( data ) : ( new Function("return " + data) )();
		
					}
					else {
						da.error( "Invalid JSON: " + data );
					}
				
			},

			//Evalulates a script in a global context
			globalEval: function( data ) {
				if ( data && daRe_notwhite.test(data) ) {
					// Inspired by code by Andrea Giammarchi
					// http://webreflection.blogspot.com/2007/08/global-scope-evaluation-and-dom.html
					var head = document.getElementsByTagName("head")[0] || document.documentElement,
							script = document.createElement("script");
		
					script.type = "text/javascript";
		
					if ( da.support.scriptEval ) {																//ͨ��scriptԪ�����벢ִ���Զ������
						script.appendChild( document.createTextNode( data ) );
					}
					else {
						script.text = data;
					}
		
					head.insertBefore( script, head.firstChild );									//��insertBefore������appendChild�ǣ�����IE6��bug
					head.removeChild( script );
				}
			},
			
			/**��xml����תΪjson���ݸ�ʽ
			* param {XMLDocument} xml XMLԭ����
			* param {Function} fn �Զ���ص�����/ɸѡ����
			*/
			xml2json: function( xml, fn ){
				var newSet,
					json, tmp, rowObj, rowNode, colNode, 
					dsname, dsname2, name, value;
				if( !xml.childNodes || 0 >= xml.childNodes.length ) return null;
				
				json = {};
				tmp = {};

				for( var i=0,i2=0,lenDS=xml.childNodes.length; i<lenDS; i++ ){
					newSet = xml.childNodes[i];
					
					for( var n=0,n2=0,lenROW=newSet.childNodes.length; n<lenROW; n++ ){						//ѭ���������ݼ��ļ�¼��ͨ��nodeName�������ݼ�����
						rowNode = newSet.childNodes[n];
						if( 3 === rowNode.nodeType ) continue;												//text������ЧԪ�� ���Ѿ����޳�
						rowObj = {};
						dsname = rowNode.nodeName;															//���ݼ���
						
						if( 0 === n2)
							dsname2 = dsname;
						
						if( !tmp[ dsname ] )
							tmp[ dsname ] = [];				//������һ�����ݼ�����
							
						
						for( var m=0,m2=0,lenCOL=rowNode.childNodes.length; m<lenCOL; m++ ){				//ѭ��ÿ�м�¼��ͨ��nodeName�����ֶλ���
							colNode = rowNode.childNodes[m];
							if( 3 === colNode.nodeType ) continue;											//�ų�text������ЧԪ��
							name = colNode.nodeName;														//����
							value = ( undefined === colNode.text ) ? colNode.textContent : colNode.text;
						
							rowObj[ name ] = value;

							fn && fn( "field", dsname, { name:name, value:value }, m2 );
							m2++;		//��Ч���� +1
						}
						
						
						if( fn && (false === fn( "record", dsname, rowObj, n2 )) ){						//�����ֺõ��ֶ����ݣ�ѹ���Ӧ�����ݼ�������
							continue;
						}
						tmp[ dsname ].push( rowObj );
						n2++;			//��Ч���� +1
						
						
						if( dsname2 !== dsname ){
							if( fn && (false === fn( "dataset", dsname, tmp[ dsname2 ], i2 )) ){			//�������ݼ�
								continue;
							}
							json[ dsname2 ] = tmp[ dsname2 ];
							
							dsname2 = dsname;
							i2++;				//��Ч���ݼ��� +1
						}
					}
					
					
					if( fn && (false === fn( "dataset", dsname, tmp[ dsname2 ], i2 )) ){			//�������ݼ�
						continue;
					}
					json[ dsname2 ] = tmp[ dsname2 ];
				}

				return json;
				
			}
			
		});	
	
		
		da.each("Boolean Number String Function Array Date RegExp Object".split(" "), function(i, name) {
			class2type[ "[object " + name + "]" ] = name.toLowerCase();
		});
	
		if ( !daRe_white.test( "\xA0" ) ) {									//��������ʽ��\sƥ��ո���ţ�IE�п��ܻ�ʧ�ܡ�
			daRe_trimLeft = /^[\s\xA0]+/;
			daRe_trimRight = /[\s\xA0]+$/;
		}

		//����document��ready�¼�����
		if ( doc.addEventListener ) {
			DOMContentLoaded = function() {
				doc.removeEventListener( "DOMContentLoaded", DOMContentLoaded, false );
				da.ready();
			};
		
		} else if ( doc.attachEvent ) {
			DOMContentLoaded = function() {
				if ( doc.readyState === "complete" ) {					//���IEҪ�ж�body�Ƿ��Ѿ��������
					doc.detachEvent( "onreadystatechange", DOMContentLoaded );
					da.ready();
				}
			};
		}

		//����IE ���DOM�Ƿ��Ѿ��������
		function doScrollCheck() {
			if ( da.isReady ) {
				return;
			}
		
			try {
				doc.documentElement.doScroll("left");	//���IE ����DOMContentLoaded������һ�ּ���������ondocumentready֮ǰ��һֱ���쳣��
			} catch(e) {
				setTimeout( doScrollCheck, 1 );			//ͨ����������doScrollCheck�ﵽ����documentready��Ч��
				return;
			}
		
			da.ready();									//documentready�͵���da.ready();
		};
		
		daDoc = da( doc );
		
		return da;
	})();

	
/*********************** Support *****************************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: ���������
	version: 1.0.0
*/
(function(da){
	da.support = (function(){
		//������������ж�
		var	div = document.createElement("div"),
			id = "script" + da.nowId(),
			select,
			opt,
			input,
			fragment;
				
		div.setAttribute("className", "t");
		div.innerHTML = "   <link/><table></table><a style='color:red;float:left;opacity:.55;'>a</a><input type='checkbox'/>";
		var a = div.getElementsByTagName("a")[0];
		if (!a ) return;
		
		// First batch of supports tests
		select = document.createElement( "select" );
		opt = select.appendChild( document.createElement("option") );
		input = div.getElementsByTagName( "input" )[ 0 ];

		support = {
			leadingWhitespace: ( div.firstChild.nodeType === 3 ),		// IE strips leading whitespace when .innerHTML is used
		
			tbody: !!div.getElementsByTagName( "tbody" ).length,		//�ж��Ƿ��Զ�������tbody��ǩԪ�أ�IE��Կյ�table��ǩ�Զ�����tbody��ǩԪ��

			htmlSerialize: !!div.getElementsByTagName( "link" ).length,	//�ж�linkԪ���ܷ�ͨ��innerHTML��ȷ�ı����л���IE�в���ͨ��innerHTML�����Ĵ��л�link��script��ǩԪ��
			
			opacity: /^0.55$/.test( a.style.opacity ),					//opacity ��͸�������Լ������ж�
			cssFloat: !!a.style.cssFloat,								//float ����λ�����Լ������ж�

			// Make sure that if no value is specified for a checkbox
			// that it defaults to "on".
			// (WebKit defaults to "" instead)
			checkOn: ( input.value === "on" ),

			// Make sure that a selected-by-default option has a working selected property.
			// (WebKit defaults to false instead of true, IE too, if it's in an optgroup)
			optSelected: opt.selected,						//��֤optionĬ��ѡ�����selected����
	
			getComputedStyle: doc.defaultView && doc.defaultView.getComputedStyle,		//defaultView.getComputedStyle ����֧���ж�
			
			getSetAttribute: div.className !== "t",			//�����IE������ͨ���շ��ʽֵ��������,��ʱ���ڽ������Բ���ʱ��Ҫ���м��ݴ����ˡ�
			
			// Makes sure cloning an html5 element does not cause problems
			// Where outerHTML is undefined, this still works
			html5Clone: document.createElement("nav").cloneNode( true ).outerHTML !== "<:nav></:nav>",
			
			boxModel: null,									//����ģ��֧��
			inlineBlockNeedsLayout: false,					//inline-block֧��
			shrinkWrapBlocks: false,						//����֧��
			// reliableHiddenOffsets: true,					//����Ԫ�ؿɿ���֧��
			
			scriptEval: false,								//�ж��Ƿ�֧��scriptԪ�����벢ִ���Զ������
			deleteExpando: true,												
			ajax: false										//�Ƿ�֧��XHR requests
		};		
		
		// Make sure checked status is properly cloned
		input.checked = true;
		support.noCloneChecked = input.cloneNode( true ).checked;

		// Make sure that the options inside disabled selects aren't marked as disabled
		// (WebKit marks them as disabled)
		select.disabled = true;
		support.optDisabled = !opt.disabled;

		try {																						//ͨ��try��֤�Ƿ���ͨ��deleteɾ��Ԫ�أ��Զ�����չ���ԣ�IE���쳣��
			delete div.test;
		} catch( e ) {
			support.deleteExpando = false;
		}
		
		// Check if a radio maintains it's value
		// after being appended to the DOM
		input = document.createElement("input");
		input.value = "t";
		input.setAttribute("type", "radio");
		support.radioValue = input.value === "t";
	
		input.setAttribute("checked", "checked");
		div.appendChild( input );
		support.appendChecked = input.checked;																												// Check if a disconnected checkbox will retain its checked, value of true after appended to the DOM (IE6/7)
		
		fragment = doc.createDocumentFragment();																											//�ж��Ƿ�֧��Ԫ��checked״̬��¡
		fragment.appendChild( div.firstChild );
		support.checkClone = fragment.cloneNode( true ).cloneNode( true ).lastChild.checked;					//WebKit�ں�����������ĵ���Ƭ�в��ܹ���ȷ�Ŀ�¡checked ״̬
		
		
		if ( window[ id ] ) {														//�ж��Ƿ�֧��scriptԪ�����벢ִ���Զ�����루IE��֧�֣�ֻ��ͨ��scriptԪ�ص�text���Դ��棩
			support.scriptEval = true;
			delete window[ id ];
		}
	
		div.innerHTML = "";
	
		// Figure out if the W3C box model works as expected
		div.style.width = div.style.paddingLeft = "1px";
	
		// We use our own, invisible, body
		body = document.createElement( "body" );
		bodyStyle = {
			visibility: "hidden",
			width: 0,
			height: 0,
			border: 0,
			margin: 0,
			// Set background to avoid IE crashes when removing (#9028)
			background: "none"
		};
		for ( i in bodyStyle ) {
			body.style[ i ] = bodyStyle[ i ];
		}
		body.appendChild( div );
		document.documentElement.appendChild( body );
	
		// Check if a disconnected checkbox will retain its checked
		// value of true after appended to the DOM (IE6/7)
		support.appendChecked = input.checked;
	
		support.boxModel = div.offsetWidth === 2;
	
		if ( "zoom" in div.style ) {
			// Check if natively block-level elements act like inline-block
			// elements when setting their display to 'inline' and giving
			// them layout
			// (IE < 8 does this)
			div.style.display = "inline";
			div.style.zoom = 1;
			support.inlineBlockNeedsLayout = ( div.offsetWidth === 2 );
	
			// Check if elements with layout shrink-wrap their children
			// (IE 6 does this)
			div.style.display = "";
			div.innerHTML = "<div style='width:4px;'></div>";
			support.shrinkWrapBlocks = ( div.offsetWidth !== 2 );
		}
	
		div.innerHTML = "<table><tr><td style='padding:0;border:0;display:none'></td><td>t</td></tr></table>";
		tds = div.getElementsByTagName( "td" );
	
		// Check if table cells still have offsetWidth/Height when they are set
		// to display:none and there are still other visible table cells in a
		// table row; if so, offsetWidth/Height are not reliable for use when
		// determining if an element has been hidden directly using
		// display:none (it is still safe to use offsets if a parent element is
		// hidden; don safety goggles and see bug #4512 for more information).
		// (only IE 8 fails this test)
		isSupported = ( tds[ 0 ].offsetHeight === 0 );
	
		tds[ 0 ].style.display = "";
		tds[ 1 ].style.display = "none";
	
		// Check if empty table cells still have offsetWidth/Height
		// (IE < 8 fail this test)
		support.reliableHiddenOffsets = isSupported && ( tds[ 0 ].offsetHeight === 0 );		//����Ԫ�ؿɿ���֧��

		div.innerHTML = "";
	
		// Check if div with explicit width and no margin-right incorrectly
		// gets computed margin-right based on width of container. For more
		// info see bug #3333
		// Fails in WebKit before Feb 2011 nightlies
		// WebKit Bug 13343 - getComputedStyle returns wrong value for margin-right
		if ( document.defaultView && document.defaultView.getComputedStyle ) {
			marginDiv = document.createElement( "div" );
			marginDiv.style.width = "0";
			marginDiv.style.marginRight = "0";
			div.appendChild( marginDiv );
			support.reliableMarginRight =
				( parseInt( document.defaultView.getComputedStyle( marginDiv, null ).marginRight, 10 ) || 0 ) === 0;
		}
	
		// Remove the body element we added
		body.innerHTML = "";
		document.documentElement.removeChild( body );

		
		return support;
	})();
	
	
	// Keep track of boxModel
	da.boxModel = da.support.boxModel;
	
})(da);

/***************** Data  ***************************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: ������Ʋ�������
	version: 1.0.0
*/
(function(da){
	var daRe_multiDash = /([A-Z])/g,
		daRe_brace = /^(?:\{.*\}|\[.*\])$/,

		da_sequence = 0, 
		da_winData = {};

	function isEmptyDataObject( obj ) {									//�˲�һ����������Ƿ�Ϊ��
		for ( var name in obj ) {
			// if the public data object is empty, the private is still empty
			if ( name === "data" && da.isEmptyObj( obj[name] ) ) {
				continue;
			}
			if ( name !== "toJSON" ) {
				return false;
			}
		}
		return true;
	}

	function dataAttr( elem, key, data ) {
		// If nothing was found internally, try to fetch any
		// data from the HTML5 data-* attribute
		if ( data === undefined && elem.nodeType === 1 ) {

			var name = "data-" + key.replace( daRe_multiDash, "-$1" ).toLowerCase();

			data = elem.getAttribute( name );

			if ( typeof data === "string" ) {
				try {
					data = data === "true" ? true :
					data === "false" ? false :
					data === "null" ? null :
					da.isNumeric( data ) ? +data :
						daRe_brace.test( data ) ? da.parseJSON( data ) :
						data;
				} catch( e ) {}

				// Make sure we set the data so it isn't changed later
				da.data( elem, key, data );

			} else {
				data = undefined;
			}
		}

		return data;
	}

	da.extend({
		cache: {},							//daȫ�ֻ�����
		uuid: 0,
		
		expando: "da"+ da.nowId(),		//ÿ��ҳ������һ�����������ƣ�
											//Ԫ��ͨ�����ͬ������ֵ��������Լ��Ļ�����������ȫ�ֻ������е�������
		
		noData: {							//���µļһ��ǣ���ЩԪ���������������Ψһ��ʶ��da.expando���ԣ����׳��޷�������쳣������� ??????
			"embed": true,
			// Ban all objects except for Flash (which handle expandos)
			"object": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",
			"applet": true
		},

		hasData: function( elem ) {
			elem = elem.nodeType ? da.cache[ elem[da.expando] ] : elem[ da.expando ];
			return !!elem && !isEmptyDataObject( elem );
		},

		acceptData: function( elem ) {						//�ж�һ��Ԫ���Ƿ��ܹ����л���������ز���
			if ( elem.nodeName ) {							//�ų�����Ԫ������ �磺embed��applet��
				var match = da.noData[ elem.nodeName.toLowerCase() ];		

				if ( match ) {
					return !(match === true || elem.getAttribute("classid") !== match);
				}
			}
			return true;
		},
		
		//da���溯��
		/*
			obj:	����Ŀ�����
			key:	������������ֵ
			val:	������������
		*/
		data: function(obj, key, val, pvt/*�ڲ�˽��*/ ){
			if ( !da.acceptData( obj ) ) return;
			
			var pvtCache,									//�ڲ�˽�в��ֻ�������
				thisCache,									//�û����Ų��ֻ�������
				internalKey = da.expando,
				getByName = typeof key === "string",
				isNode = obj.nodeType,						//����IE��GC�������ջ��Ʋ�ͬ������DOMԪ�غ�js����Ĵ���ʽ��һ��
				cache = isNode ? da.cache : obj,			//ֻ��DOMԪ����Ҫȫ�ֵ�cache����ͨjs�������ݿ���ֱ��ָ����һ������
				id = isNode ? obj[ internalKey ] : obj[ internalKey ] && internalKey,
				isEvents = ("events" === key),
				ret;
			
			
			if ( getByName 									//get����ʱ����Ŀ�����û���κλ������ݣ�ֱ�ӷ��ء�
			&& undefined === val 
			&& (!id || !cache[id] || (!isEvents && !pvt && !cache[id].data))) {
				return;
			}

			if ( !id ) {
				if ( isNode ) {								//ֻ��DOMԪ�ز���Ҫһ��ȫ�ֻ�����������
					obj[ internalKey ] = id = ++da.uuid;
				}
				else {
					id = internalKey;
				}
			}
			
			if ( !cache[ id ] ) {							//ȷ���������ǿյ�,����ʼ��
				cache[ id ] = {};

				// Avoids exposing jQuery metadata on plain JS objects when the object
				// is serialized using JSON.stringify
				if ( !isNode ) {
					cache[ id ].toJSON = da.noop;
				}
			}
			
			if ( "object" === typeof key || "function" === typeof key ) {		//�Լ�ֵ�Եķ�ʽ����set����
				if ( pvt ) {													//˽�в���
					cache[ id ] = da.extend( cache[ id ], key );				//set����,ͨ��da.extend()������Ŀ����л�������
				} 
				else {															//���Ų���
					cache[ id ].data = da.extend( cache[ id ].data, key );
				}
			}

			pvtCache = thisCache = cache[ id ];

			if ( !pvt ) {									//Ϊ�˱���da���ڲ�ʹ�û��������������û�ʹ�û�������ͻ��
				if ( !thisCache.data ) {					//����Ĵ洢�ṹ�ǣ��û�ʹ�û����������Ϊ"data"�Ķ���Ƕ���ڲ�ʹ�û�������С�
					thisCache.data = {};
				}

				thisCache = thisCache.data;					//����û�ʹ�û������
			}
	
			if ( undefined !== val ) {						//set����
				thisCache[ da.camelCase( key ) ] = val;
			}

			if ( isEvents && !thisCache[ key ] ) {			//�û���������"events"��Ϊkey,��ȡ��DOMԪ���ϵļ����¼���ػ���
				return pvtCache.events;						//��Ȼǰ���ǣ����û���ʹ�õĿ�������û�ж���key��ͬ������
			}

			if ( getByName ) {								//get����,������ָ��������
				ret = thisCache[ key ];						//ԭ���������ݣ����᲻�����ݣ�ת�����շ��ʽ����������
				
				if ( ret == null ) {
					ret = thisCache[ da.camelCase( key ) ];
				}
			} 
			else {											//get������ȫ��
				ret = thisCache;
			}
			
			return ret;
		},

		/**�ڲ�˽��
		*/
		_data: function( obj, name, data ) {
			return da.data( obj, name, data, true );
		},

		//daɾ�����溯��
		/*
			obj: ����Ŀ�����
			key: ������������ֵ
		*/
		removeData: function(obj, key, pvt/*�ڲ�˽��*/) {
			if ( !da.acceptData( obj ) ) return;

			var thisCache,
				internalKey = da.expando,
				isNode = obj.nodeType,					//����IE��GC�������ջ��Ʋ�ͬ������DOMԪ�غ�js����Ĵ���ʽ��һ��
				cache = isNode ? da.cache : obj,		//ֻ��DOMԪ����Ҫȫ�ֵ�cache����ͨjs�������ݿ���ֱ��ָ����һ������
				id = isNode ? obj[ internalKey ] : internalKey;

			if ( !cache[ id ] ) return;					//û��Ŀ������κλ��棬ֱ�ӷ���
			
			if ( key ) {
				thisCache = pvt ? cache[ id ] : cache[ id ].data;	//���ڲ������������û���������

				if ( thisCache ) {
					if ( !da.isArray( key ) ) {						//֧�����顢�ո�ָ��ķ�ʽ��������
						if ( key in thisCache ){ 					//�ж��Ƿ�ֵ����
							key = [ key ];
						}
						else {
							key = da.camelCase( key );
							if ( key in thisCache ) {				//תΪ�շ��ʽ�����ж��Ƿ�ֵ����
								key = [ key ];
							} 
							else {									//ȷ��Ϊ�ո�ָ��ķ�ʽ��������
								key = key.split( " " );
							}
						}
					}

					for ( var i = 0, len = key.length; i < len; i++ ) {
						delete thisCache[ key[i] ];
					}

					if ( !( pvt ? isEmptyDataObject : da.isEmptyObj )( thisCache ) ) {		//��������Ȼ���������������ݣ���ʱ�Ϳ������˳��ˡ�
						return;
					}
				}
			}

			if ( !pvt ) {										//�������Ѿ�û�������κλ��������ˣ��ͽ�����������Ҳ����
				delete cache[ id ].data;

				if ( !isEmptyDataObject(cache[ id ]) ) {		//�ⲿ�û���������������ڲ�˽�õĻ�����
					return;
				}
			}

			// Browsers that fail expando deletion also refuse to delete expandos on
			// the window, but it will allow it on all other JS objects; other browsers
			// don't care
			// Ensure that `cache` is not a window object #10080
			if ( da.support.deleteExpando || !cache.setInterval ) {
				delete cache[ id ];
			}
			else {
				cache[ id ] = null;
			}
			
			// We destroyed the cache and need to eliminate the expando on the node to avoid
			// false lookups in the cache for entries that no longer exist
			if ( isNode ) {
				// IE does not allow us to delete expando properties from nodes,
				// nor does it have a removeAttribute function on Document nodes;
				// we must handle all of these cases
				if ( da.support.deleteExpando ) {
					delete obj[ internalKey ];
				} 
				else if ( obj.removeAttribute ) {
					obj.removeAttribute( internalKey );
				}
				else {
					obj[ internalKey ] = null;
				}
			}
		}
	});

	da.fnStruct.extend({
		data: function( key, value ) {
			var parts, part, attr, name, l,
				elem = this.dom[0],
				i = 0,
				data = null;

			// Gets all values
			if ( key === undefined ) {
				if ( this.dom.length ) {
					data = da.data( elem );

					if ( elem.nodeType === 1 && !da._data( elem, "parsedAttrs" ) ) {
						attr = elem.attributes;
						for ( l = attr.length; i < l; i++ ) {
							name = attr[i].name;

							if ( name.indexOf( "data-" ) === 0 ) {
								name = da.camelCase( name.substring(5) );

								dataAttr( elem, name, data[ name ] );
							}
						}
						da._data( elem, "parsedAttrs", true );
					}
				}

				return data;
			}

			// Sets multiple values
			if ( typeof key === "object" ) {
				return this.each(function() {
					da.data( this, key );
				});
			}

			parts = key.split( ".", 2 );
			parts[1] = parts[1] ? "." + parts[1] : "";
			part = parts[1] + "!";

			return da.access( this, function( value ) {

				if ( value === undefined ) {
					data = this.triggerHandler( "getData" + part, [ parts[0] ] );

					// Try to fetch any internally stored data first
					if ( data === undefined && elem ) {
						data = da.data( elem, key );
						data = dataAttr( elem, key, data );
					}

					return data === undefined && parts[1] ?
						this.data( parts[0] ) :
						data;
				}

				parts[1] = value;
				this.each(function() {
					var self = da( this );

					self.triggerHandler( "setData" + part, parts );
					da.data( this, key, value );
					self.triggerHandler( "changeData" + part, parts );
				});
			}, null, value, arguments.length > 1, null, false );
		},

		removeData: function( key ) {
			return this.each(function() {
				da.removeData( this, key );
			});
		}
	});

	
})(da);

/***************** Attr *****************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: Element���Թ����� ���Ĵ���
	version: 1.0.0
*/
(function(da){
	var daRe_class = /[\n\t\r]/g,
		daRe_space = /\s+/,
		daRe_return = /\r/g,
		daRe_type = /^(?:button|input)$/i,
		daRe_focusable = /^(?:button|input|object|select|textarea)$/i,
		daRe_clickable = /^a(?:rea)?$/i,
		daRe_special = /^(?:data-|aria-)/,
		daRe_invalidChar = /\:/,
		formHook;
			
	da.fnStruct.extend({
		attr: function( name, value ) {
			return da.access( this, da.attr, name, value, arguments.length > 1 );
		},
	
		removeAttr: function( name ) {
			return this.each(function() {
				da.removeAttr( this, name );
			});
		},
		
		/**�ж�Ԫ���Ƿ����class��ʽ
		*/
		hasClass: function( str ) {
			var target = " " + str + " ";
			
			for ( var i = 0, len = this.dom.length; i < len; i++ ) {
				if ( 0 <= (" " + this.dom[i].className + " ").replace(daRe_class, " ").indexOf( target ) ) {
					return true;
				}
			}

			return false;
		},
		
		/**���class��ʽ
		*/
		addClass: function( param ) {
			if ( da.isFunction( param ) ) {
				return this.each(function(i) {
					var item = da(this);
					item.addClass( param.call(this, i, item.attr("class") || "") );
				});
			}

			if ( param && "string" === typeof param ) {
				var arrClass = (param || "").split( daRe_space );

				for ( var i = 0, len = this.dom.length; i < len; i++ ) {
					var item = this.dom[i];

					if ( 1 === item.nodeType ) {
						if ( !item.className ) {									//classNameΪ��,ֱ�����
							item.className = param;

						}
						else {														//׷��
							var curClass = " " + item.className + " ",				//��ǰclassName,ǰ���" "���ڲ���
								newClass = item.className;

							for ( var n = 0, len2 = arrClass.length; n < len2; n++ ) {
								if ( 0 > curClass.indexOf( " " + arrClass[n] + " " ) ) {
									newClass += " " + arrClass[n];
								}
							}
							item.className = da.trim( newClass );
						}
					}
				}
			}

			return this;
		},
		
		/**�Ƴ�class��ʽ
		*/
		removeClass: function( param ) {
			if ( da.isFunction(param) ) {
				return this.each(function(i) {
					var item = da(this);
					item.removeClass( param.call(this, i, item.attr("class")) );
				});
			}

			if ( (param && typeof param === "string") || param === undefined ) {
				var arrClass = (param || "").split( daRe_space );

				for ( var i = 0, len = this.dom.length; i < len; i++ ) {
					var item = this.dom[i];

					if ( 1 === item.nodeType && item.className ) {
						if ( param ) {
							var curClass = (" " + item.className + " ").replace(daRe_class, " ");		//ȥ�ո񡢻��С��Ʊ��
							
							for ( var n = 0, len2 = arrClass.length; n < len2; n++ ) {
								curClass = curClass.replace(" " + arrClass[n] + " ", " ");
							}
							item.className = da.trim( curClass );

						} else {
							item.className = "";
						}
					}
				}
			}

			return this;
		},
		
		/**class��ʽ����ɾ����
		*/
		switchClass: function( param, isAdd ) {
			var type = typeof param,
				isForce = !!isAdd;						//���ڶ�����Ϊtrueʱ��ǿ�����class��ʽ
	
			if ( da.isFunction( param ) ) {
				return this.each(function(i) {
					var item = da(this);
					item.switchClass( param.call(this, i, item.attr("class"), isAdd), isAdd );
				});
			}

			return this.each(function() {
				if ( type === "string" ) {
					var item = da( this ),
						arrClass = param.split( daRe_space ),
						state = isAdd,
						className,
						n = 0;

					while ( (className = arrClass[ n++ ]) ) {
						state = isForce ? state : !item.hasClass( className );		//���ǿ�����ã��͸��ݵ�ǰ״̬����ɾ
						item[ state ? "addClass" : "removeClass" ]( className );
					}
				}
				else if ( type === "undefined" || type === "boolean" ) {			//����Ԫ��class��ʽ������ɾ�л�
					if ( this.className ) {
						da.data( this, "_da_switchClass", this.className );			//����ɵ�class��ʽ
					}

					this.className = (this.className || param === false) ? "" : da.data( this, "_da_switchClass" ) || "";
				}
			});
		},
		
		val: function( value ) {
			var hooks, ret,
					elem = this.dom[0];
			
			if ( !arguments.length ) {
				if ( elem ) {
					hooks = da.valHooks[ elem.nodeName.toLowerCase() ] || da.valHooks[ elem.type ];
	
					if ( hooks && "get" in hooks && (ret = hooks.get( elem, "value" )) !== undefined ) {
						return ret;
					}
	
					return (elem.value || "").replace(daRe_return, "");
				}
	
				return undefined;
			}
	
			var isFunction = da.isFunction( value );
	
			return this.each(function( i ) {
				var self = da(this), val;
	
				if ( this.nodeType !== 1 ) {
					return;
				}
	
				if ( isFunction ) {
					val = value.call( this, i, self.val() );
				} else {
					val = value;
				}
	
				// Treat null/undefined as ""; convert numbers to string
				if ( val == null ) {
					val = "";
				} else if ( typeof val === "number" ) {
					val += "";
				} else if ( da.isArray( val ) ) {
					val = da.map(val, function ( value ) {
						return value == null ? "" : value + "";
					});
				}
	
				hooks = da.valHooks[ this.nodeName.toLowerCase() ] || da.valHooks[ this.type ];
	
				// If set returns undefined, fall back to normal setting
				if ( !hooks || ("set" in hooks && hooks.set( this, val, "value" ) === undefined) ) {
					this.value = val;
				}
			});
		}
		
	});


	da.extend({
		attrFn: {
			val: true,
			css: true,
			html: true,
			text: true,
			data: true,
			width: true,
			height: true,
			offset: true
		},
		
		attrFix: {
			// Always normalize to ensure hook usage
			tabindex: "tabIndex",
			readonly: "readOnly"
		},
		
		//��������Hook����
		attrHooks: {
			type: {
				set: function( elem, value ) {
					if ( daRe_type.test( elem.nodeName ) && elem.parentNode ) {		//����IE,ĳЩԪ�ز�����ı�Ԫ�ص�type����
						da.error( "��ܰ��ʾ:button��inputԪ�أ�������ı�type����" );
					} 
					else if ( !da.support.radioValue 
					&& "radio" === value 
					&& da.isNodeName(elem, "input") ) {								//����IE,���ĳԪ������typeΪradio���ͣ���Ҫ��������Ĭ��valueֵ
						var val = elem.getAttribute("value");
						elem.setAttribute( "type", value );
						
						if ( val ) elem.value = val;
						
						return value;
					}
					
				}
			},
			tabIndex: {
				get: function( elem ) {
					// elem.tabIndex doesn't always return the correct value when it hasn't been explicitly set
					// http://fluidproject.org/blog/2008/01/09/getting-setting-and-removing-tabindex-values-with-javascript/
					var attributeNode = elem.getAttributeNode("tabIndex");
	
					return attributeNode && attributeNode.specified ?
						parseInt( attributeNode.value, 10 ) :
						( daRe_focusable.test( elem.nodeName ) || daRe_clickable.test( elem.nodeName ) && elem.href ) ? 
						0 : undefined;
				}
			}
		},
		
		//����Ԫ�صĸ�ֵHook����
		valHooks: {
			option: {
				get: function( elem ) {
					// attributes.value is undefined in Blackberry 4.7 but
					// uses .value. See #6932
					var val = elem.attributes.value;
					return !val || val.specified ? elem.value : elem.text;
				}
			},
			
			select: {
				get: function( elem ) {
					var index = elem.selectedIndex,
						values = [],
						options = elem.options,
						one = elem.type === "select-one";
	
					// Nothing was selected
					if ( index < 0 ) {
						return null;
					}
	
					// Loop through all the selected options
					for ( var i = one ? index : 0, max = one ? index + 1 : options.length; i < max; i++ ) {
						var option = options[ i ];
	
						// Don't return options that are disabled or in a disabled optgroup
						if ( option.selected && (da.support.optDisabled ? !option.disabled : option.getAttribute("disabled") === null) &&
								(!option.parentNode.disabled || !da.isNodeName( option.parentNode, "optgroup" )) ) {
	
							// Get the specific value for the option
							value = da( option ).val();
	
							// We don't need an array for one selects
							if ( one ) {
								return value;
							}
	
							// Multi-Selects return an array
							values.push( value );
						}
					}
	
					// Fixes Bug #2551 -- select.val() broken in IE after form.reset()
					if ( one && !values.length && options.length ) {
						return da( options[ index ] ).val();
					}
	
					return values;
				},
	
				set: function( elem, value ) {
					var values = da.pushArray( value );
	
					da(elem).find("option").each(function() {
						this.selected = da.isInArray( da(this).val(), values ) >= 0;
					});
	
					if ( !values.length ) {
						elem.selectedIndex = -1;
					}
					return values;
				}
			}
		},

		//����Ԫ�����Բ�������
		/*
			elem: Ԫ�ض���
			name: ��������
			value:  ����ֵ
			pass: �Ƿ�ͨ��da�����Ӧ ��Ա��������������ֵ
		*/
		attr: function( elem, name, value, pass ) {
			var nType = elem.nodeType;																			//���Ԫ�ض���ڵ�����
			
			if ( !elem || nType === 3 || nType === 8 || nType === 2 ) {			//���ܶ��ı���ע�͡�XML���Խڵ�������Բ�����ֱ�ӷ���undefined
				return undefined;
			}
	
			if ( pass && name in da.attrFn ) {															//����ͨ�������Ա������������ԵĴ������Ҹ�����������������֮��Ӧ�Ĵ���������ֱ�ӵ��ó�Ա�������д���
				return da( elem )[ name ]( value );
			}
			
			var ret, hooks,
					notxml = nType !== 1 || !da.isXMLDoc( elem );
			
			// Normalize the name if needed
			name = notxml && da.attrFix[ name ] || name;
	
			// Get the appropriate hook, or the formHook
			// if getSetAttribute is not supported and we have form objects in IE6/7
			hooks = da.attrHooks[ name ] ||
				( formHook && (da.isNodeName( elem, "form" ) || daRe_invalidChar.test( name )) ?
					formHook :
					undefined );
	
			if ( value !== undefined ) {									//set����
				if ( value === null || (value === false && !daRe_special.test( name )) ) {
					da.removeAttr( elem, name );
					return undefined;
	
				} 
				else if ( hooks 
				&& "set" in hooks 
				&& notxml 
				&& undefined !== (ret = hooks.set( elem, value, name )) ) {
					return ret;
	
				} 
				else {
					// Set boolean attributes to the same name
					if ( value === true 
					&& !daRe_special.test( name ) )
						value = name;
	
					elem.setAttribute( name, "" + value );
					return value;
				}
	
			} 
			else {															//get����
				if ( hooks && "get" in hooks && notxml ) {
					return hooks.get( elem, name );
	
				} 
				else {
					ret = elem.getAttribute( name );
					
					return null === ret ? undefined : ret;					// Non-existent attributes return null, we normalize to undefined
				}
			}
		},
		
		//�Ƴ�Ԫ������
		/*
			elem: Ԫ�ض���
			name: ������
		*/
		removeAttr: function( elem, name ) {
				if ( 1 === elem.nodeType ) {
						name = da.attrFix[ name ] || name;
					
						if ( da.support.getSetAttribute ) {							//�ж�������Ƿ�֧��removeAttribute����
							elem.removeAttribute( name );
						}
						else {														//�����֧�֣�����ͨ��XML�ڵ��Ƴ��������
							da.attr( elem, name, "" );
							elem.removeAttributeNode( elem.getAttributeNode( name ) );
						}
				}
		}
		
	});


	// IE6/7 do not support getting/setting some attributes with get/setAttribute
	if ( !da.support.getSetAttribute ) {											//����IE�շ��ʽ
		da.attrFix = da.extend( da.attrFix, {
			"for": "htmlFor",
			"class": "className",
			maxlength: "maxLength",
			cellspacing: "cellSpacing",
			cellpadding: "cellPadding",
			rowspan: "rowSpan",
			colspan: "colSpan",
			usemap: "useMap",
			frameborder: "frameBorder"
		});
		
		// Use this for any attribute on a form in IE6/7
		formHook = da.attrHooks.name = da.attrHooks.value = da.valHooks.button = {
			get: function( elem, name ) {
				var ret;
				if ( name === "value" && !da.isNodeName( elem, "button" ) ) {
					return elem.getAttribute( name );
				}
				ret = elem.getAttributeNode( name );
				// Return undefined if not specified instead of empty string
				return ret && ret.specified ?
					ret.nodeValue :
					undefined;
			},
			set: function( elem, value, name ) {
				// Check form objects in IE (multiple bugs related)
				// Only use nodeValue if the attribute node exists on the form
				var ret = elem.getAttributeNode( name );
				if ( ret ) {
					ret.nodeValue = value;
					return value;
				}
			}
		};
	
		// Set width and height to auto instead of 0 on empty string( Bug #8150 )
		// This is for removals
		da.each([ "width", "height" ], function( i, name ) {
			da.attrHooks[ name ] = da.extend( da.attrHooks[ name ], {
				set: function( elem, value ) {
					if ( value === "" ) {
						elem.setAttribute( name, "auto" );
						return value;
					}
				}
			});
		});
	}
	
})(da);

/***************** Event *****************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: �¼�������� ���Ĵ���
	version: 1.0.0
*/
(function(da){
	var daRe_formElems = /^(?:textarea|input|select)$/i,
		daRe_typenamespace = /^([^\.]*)?(?:\.(.+))?$/,
		// daRe_namespaces = /\.(.*)$/,
		daRe_hoverHack = /(?:^|\s)hover(\.\S+)?\b/,
		daRe_keyEvent = /^key/,
		daRe_mouseEvent = /^(?:mouse|contextmenu)|click/,
		daRe_focusMorph = /^(?:focusinfocus|focusoutblur)$/,
		daRe_quickIs = /^(\w*)(?:#([\w\-]+))?(?:\.([\w\-]+))?$/,
		daRe_escape = /[^\w\s.|`]/g;
	
	function quickParse( selector ) {
		var quick = daRe_quickIs.exec( selector );
		if ( quick ) {
			//   0  1    2   3
			// [ _, tag, id, class ]
			quick[1] = ( quick[1] || "" ).toLowerCase();
			quick[3] = quick[3] && new RegExp( "(?:^|\\s)" + quick[3] + "(?:\\s|$)" );
		}
		return quick;
	}
	
	function quickIs( elem, m ) {
		var attrs = elem.attributes || {};
		return (
			(!m[1] || elem.nodeName.toLowerCase() === m[1]) &&
			(!m[2] || (attrs.id || {}).value === m[2]) &&
			(!m[3] || m[3].test( (attrs[ "class" ] || {}).value ))
		);
	}
	
	//֧�ְ�hover�¼�(תΪmouseenter$1��mouseleave$1)
	function hoverHack( events ) {
		return da.event.special.hover ? events : events.replace( daRe_hoverHack, "mouseenter$1 mouseleave$1" );
	}
	
	//������
	function fnCleanup( nm ) {
		return nm.replace( daRe_escape, "\\$&" );
	}
	
	//�㷵��False�ĺ���
	function fnReturnFalse() {
		return false;
	}
	
	//�㷵��True�ĺ���
	function fnReturnTrue() {
		return true;
	}
	
	//�¼��Ƴ���������
	da.removeEvent = document.removeEventListener ?
	function( elem, type, handle ) {
		if ( elem.removeEventListener ) {
			elem.removeEventListener( type, handle, false );
		}
	} : 
	function( elem, type, handle ) {
		if ( elem.detachEvent ) {
			elem.detachEvent( "on" + type, handle );
		}
	};

	//da.Event�๹�캯��
	/*
		src: ԭʼ��event����Ҳ�������¼������ַ����磺"click","mouseover"��( thisΪ��װ���event���� )
	*/
	da.Event = function( src ) {
		if ( !this.preventDefault ) {				//ȡ��Ĭ�ϵ��¼�����
			return new da.Event( src );
		}
	
		if ( src && src.type ) {
			this.originalEvent = src;					//��ԭʼevent���󻺴��룬��event��������Ա����У�������ԭ�͸���ʱ����
			this.type = src.type;

			// Events bubbling up the document may have been marked as prevented
			// by a handler lower down the tree; reflect the correct value.
			this.isDefaultPrevented = (src.defaultPrevented || src.returnValue === false || src.getPreventDefault && src.getPreventDefault()) ? 
					fnReturnTrue : fnReturnFalse;
		}
		else {
			this.type = src;									//���src����Ĳ������ַ������ͣ�da.Event("click");
		}
	
		this.timeStamp = da.nowId();				//����timeStamp,��Ϊfirefox��һЩevent��ʱ�����׼ȷ�����Ի����Լ���������ñ���
		this[ da.expando ] = true;				//�Ե�ǰevent�������������װ����ı�־
		
	};
	
	//��da.Event����ԭ�ͽ��и���
	da.Event.prototype = {
		isDefaultPrevented: fnReturnFalse,
		isPropagationStopped: fnReturnFalse,
		isImmediatePropagationStopped: fnReturnFalse,
		
		//ȡ���¼�Ĭ�϶���
		preventDefault: function() {
			this.isDefaultPrevented = fnReturnTrue;					//��ֹ�¼�Ĭ�϶��� �ж�����( Ĭ�Ϸ���Ϊfalse�������� )
			
			var e = this.originalEvent;											//����ԭʼ�¼�����
			if ( !e ) return;
			
			if ( e.preventDefault )	e.preventDefault();			//����¼���������preventDefault()�������͵���
			else e.returnValue = false;											//���û��preventDefault()����,�ͽ�returnValue����ֵ����Ϊfalse����Ҳ�����IE�������
		},
		
		//��ֹ�����¼�ð��
		stopPropagation: function() {
			this.isPropagationStopped = fnReturnTrue;				//��ֹ�����¼�ð�� �ж�����( Ĭ�Ϸ���Ϊfalse�������� )
	
			var e = this.originalEvent;											//����ԭʼ�¼�����
			if ( !e ) return;
			
			if ( e.stopPropagation ) e.stopPropagation();		//����¼���������stopPropagation()�������͵���
			else e.cancelBubble = true;											//���û��stopPropagation()����,�ͽ�cancelBubble����ֵ����Ϊtrue����Ҳ�����IE�������
				
		},
		
		//��ֹ���ش����ȼ����¼���Ӧ �͸����¼�����( �¼�ð�� )
		stopImmediatePropagation: function() {
			this.isImmediatePropagationStopped = fnReturnTrue;			//��ֹ���غ͸���ð�� �ж�����( Ĭ�Ϸ���Ϊfalse�������� )
			
			this.stopPropagation();													//����¼���������stopPropagation()�������͵���
			
		}
	};
	
	//1.3.5�汾׷�ӣ��������ʹ��
	da.Event.prototype.noDefault = da.Event.prototype.preventDefault;
	da.Event.prototype.noParent = da.Event.prototype.stopPropagation;

	da.event = {
		props: ["altKey","attrChange","attrName","bubbles","button","cancelable","charCode",
				"clientX","clientY","ctrlKey","currentTarget","data","detail","eventPhase",
				"fromElement","handler","keyCode","layerX","layerY","metaKey","newValue",
				"offsetX","offsetY","pageX","pageY","prevValue","relatedNode","relatedTarget",
				"screenX","screenY","shiftKey","srcElement","target","toElement","view",
				"wheelDelta","which"],										//event��������� ��Ա�б�
		guid: 1,
		// proxy: da.proxy,
		
		fixHooks: {},

		keyHooks: {
			props: "char charCode key keyCode".split(" "),
			filter: function( event, original ) {
				if ( event.which == null ) {					//����which����԰����¼� charCode�����̣�keyCode����꣩
					event.which = original.charCode != null ? original.charCode : original.keyCode;
				}

				return event;
			}
		},

		mouseHooks: {
			props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
			filter: function( event, original ) {
				var eventDoc, doc, body,
					button = original.button,
					fromElement = original.fromElement;

				if ( event.pageX == null && original.clientX != null ) {	//����pageX/Y��clientX/Y����,event�¼���λ�������page�����ҳ����Թ�����
																			//clientλ�û�Ҫ����scroll�������IE���������Ҫ��ȥbody�ı߿��
					eventDoc = event.target.ownerDocument || document;		
					doc = eventDoc.documentElement;
					body = eventDoc.body;

					event.pageX = original.clientX + ( doc && doc.scrollLeft || body && body.scrollLeft || 0 ) - ( doc && doc.clientLeft || body && body.clientLeft || 0 );
					event.pageY = original.clientY + ( doc && doc.scrollTop  || body && body.scrollTop  || 0 ) - ( doc && doc.clientTop  || body && body.clientTop  || 0 );
				}

				if ( !event.relatedTarget && fromElement ) {				//����relatedTarget���ԣ����mouseover��mouserout�¼���
																			//IE�ֳ���to��from�������Դ�ţ�FFû�з�
					event.relatedTarget = fromElement === event.target ? original.toElement : fromElement;
				}

				//�� IE ���� û�а���������ʱ�� event.button = 0; �����1; �м���4; �Ҽ���2
				//�� Firefox ���� û�а���������ʱ�� event.button = 0; �����0 ;�м���1 ;�Ҽ���2
				//TODO: ���ǲ���׼�ģ���ò�Ҫ�����
				if ( !event.which && button !== undefined ) {
					event.which = ( button & 1 ? 1 : ( button & 2 ? 3 : ( button & 4 ? 2 : 0 ) ) );
				}

				return event;
			}
		},
		
		//�¼���װ����
		/*
			event: �¼�����
		*/
		fix: function( event ) {
			if ( event[ da.expando ] ) {							//event�����Ѿ���װ��, ֱ���˳�
				return event;
			}
	
			var originalEvent = event,								//����һ��ԭʼevent����
				fixHook = da.event.fixHooks[ event.type ] || {};
				copy = fixHook.props ? this.props.concat( fixHook.props ) : this.props;
				
			event = da.Event( originalEvent );						//event���󲢶������ԭ�͸���
	
			for ( var i = copy.length; i; ) {						//�̳������ԭevent���������
				prop = copy[ --i ];
				event[ prop ] = originalEvent[ prop ];
			}
		
			if ( !event.target ) {									//����target���Ե���Ҫ�ԣ�����Ҫ�ٴ�ȷ���Ƿ񱻼̳й���(����IE 6/7/8��Safari2)
				event.target = originalEvent.srcElement || document;
			}

			if ( event.target.nodeType === 3 ) {					//����target����ָ�����һ���ı�����(����Safari)
				event.target = event.target.parentNode;
			}

			if ( event.metaKey === undefined ) {					//����metaKey��ƻ������û��Ctrl����ֻ��meta��
				event.metaKey = event.ctrlKey;
			}

			return fixHook.filter? fixHook.filter( event, originalEvent ) : event;			//�����¼�����Ҫ����ɸѡ����
		},
		
		global: {},						//�¼�����ע��ʹ���������־��

		//�����Զ����¼�������ͨ�������ռ����������ִ��( this�Ǵ���event�¼���ԴԪ�ض��� )
		/*
			event: �Ѿ���װ����da.Event�¼�����
		*/
		dispatch: function( event ) {
			event = da.event.fix( event || window.event );				//���������event���󣬱�֤���Ƿ�װ����
			
			var handlers = ( (da._data( this, "events" ) || {} )[ event.type ] || []),
				delegateCount = handlers.delegateCount,
				args = [].slice.call( arguments, 0 ),					//���黯�����б�
				run_all = !event.exclusive && !event.namespace,
				special = da.event.special[ event.type ] || {},
				handlerQueue = [],
				daObj, cur, selMatch, matches, handleObj, sel;
			
			args[0] = event;											//�÷�װ�õ�Event�������ԭ�������event����ʹ��
			event.delegateTarget = this;								//�¼��й�Ŀ��ָ���Լ�
			
			/*TODO:	
			// Call the preDispatch hook for the mapped type, and let it bail if desired
			if ( special.preDispatch && special.preDispatch.call( this, event ) === false ) {
				return;
			} */

			// Determine handlers that should run if there are delegated events
			if ( delegateCount && !(event.button && event.type === "click") ) {			//���������󵥻����¼�ð��
				// Pregenerate a single jQuery object for reuse with .is()
				daObj = da(this);
				daObj.context = this.ownerDocument || this;

				for ( cur = event.target; cur != this; cur = cur.parentNode || this ) {	//�¼�ð�ݴ���
					if ( cur.disabled !== true ) {										//���������õ�Ԫ��
						selMatch = {};
						matches = [];
						daObj.dom[0] = cur;
						
						for ( var i = 0; i < delegateCount; i++ ) {						
							handleObj = handlers[ i ];									//�¼�����ṹ��
							sel = handleObj.selector;									//ί�ж���ѡ����

							if ( selMatch[ sel ] === undefined ) {
								selMatch[ sel ] = (										//����ƥ���¼�ί�ж���
									handleObj.quick ? quickIs( cur, handleObj.quick ) : daObj.is( sel )
								);
							}
							if ( selMatch[ sel ] ) {
								matches.push( handleObj );
							}
						}
						
						if ( matches.length ) {
							handlerQueue.push({ elem: cur, matches: matches });
						}
					}
				}
			}
			
			// Add the remaining (directly-bound) handlers
			if ( handlers.length > delegateCount ) {
				handlerQueue.push({ elem: this, matches: handlers.slice( delegateCount ) });
			}

			// Run delegates first; they may want to stop propagation beneath us
			for ( var i = 0; i < handlerQueue.length && !event.isPropagationStopped(); i++ ) {
				matched = handlerQueue[ i ];
				event.currentTarget = matched.elem;

				for ( var j = 0; j < matched.matches.length && !event.isImmediatePropagationStopped(); j++ ) {
					handleObj = matched.matches[ j ];

					// Triggered event must either 1) be non-exclusive and have no namespace, or
					// 2) have namespace(s) a subset or equal to those in the bound event (both can have no namespace).
					if ( run_all 
					|| (!event.namespace && !handleObj.namespace) 
					|| event.namespace_re && event.namespace_re.test( handleObj.namespace ) ) {

						event.data = handleObj.data;
						event.handleObj = handleObj;

						ret = ( (da.event.special[ handleObj.origType ] || {}).handle || handleObj.handler )
									.apply( matched.elem, args );

						if ( ret !== undefined ) {
							event.result = ret;
							if ( ret === false ) {
								event.preventDefault();
								event.stopPropagation();
							}
						}
					}
				}
			}
			
			// Call the postDispatch hook for the mapped type
			if ( special.postDispatch ) {
				special.postDispatch.call( this, event );
			}

			return event.result;
		},
	
		//��Ԫ�ذ��¼�
		/*
			elem: Ŀ��Ԫ�ض���
			types: �¼�����
			handler: �Զ����¼��ص�����,ֵΪfalse���������¼���Ӧ
			data: �����Զ��崫�����ݶ���
		*/
		add: function( elem, types, handler, data, selector ) {
			var tns, type, namespaces, 
				elemData,				//Ԫ��data�������
				events, eventHandle,
				handleObjIn,			//handleObjIn���ڻ����Զ��庯����������
				handleObj,				//handleObj�¼��������ö��������¼�������ע���źͺ����Ƴ�������
				handlers;
			
			if ( elem.nodeType === 3 || elem.nodeType === 8 			//�����ı��ͱ�ע�ڵ���¼���û����
			|| !types || !handler 										//ȱ�ٱ�Ҫ����
			|| !(elemData = da._data( elem ))  ) {						//ȷ��Ԫ��data����ṹ����
				return;
			}
			
			/*
			if ( da.isWin( elem ) && ( elem !== window && !elem.frameElement ) ) {		//IE���������ֱ�Ӷ�window��������������ȸ���һ��
				elem = window;
			}
			
			if ( handler === false ) handler = fnReturnFalse;							//���handler��ֵΪfalse���������¼���Ӧ
			else if ( !handler ) return;
			*/
			
			if ( handler.handler ) {							//�����3�����������Լ�ֵ�Եķ�ʽ �磺{ handler: function(){����}, guid: 520 }
				handleObjIn = handler;							//�����û�ԭ��������(�����Ǽ�ֵ�Կ�)
				handler = handleObjIn.handler;					//����handler����������Ϊ�����ֵ�Ե�handler��������(�ڶ���,������Ĵ�����Կ���)
				selector = handleObjIn.selector;
			}
	
			if ( !handler.guid ){								//�ص�������ֵΨһ��ʶ������֮��Ĳ��һ��Ƴ�
				handler.guid = da.guid++;
			}
			
			events = elemData.events;							//����Ѿ��а󶨵��¼������ˣ����¼��������������������׷���¼���ʹ��
			eventHandle = elemData.handle;
			
			if ( !events ) {									//�״�add���¼�
				elemData.events = events = {};					//��ʼ���¼�����ṹ��
			}
			if ( !eventHandle ) {								//��ʼ�������¼�������
																//����eventHandle��������Ԫ�ص�data����ṹ elemData === { events: {}, handle: function(){����} }
				elemData.handle = eventHandle = function( e ) {	//����һ���Ѿ����ٵ�ҳ���¼������� �� ��ʱ����da.event.trigger()�������ͬһ�¼�
					return "undefined" !== typeof da && (!e || e.type !== da.event.triggered ) ?
						da.event.dispatch.apply( eventHandle.elem, arguments ) :
						undefined;
				};
				eventHandle.elem = elem;						//���¼��ص������������elem���ԣ�����¼���Ŀ��Ԫ�ذ��������IEû�б����¼�����(IE���¼������Ƿ���window������ͳһ�����),�ɷ�ֹ�ڴ�й¶�Ĵ���
			}
			
			types = da.trim( hoverHack(types) ).split( " " );	//֧�ֿո�ָ����������¼� �磺da.event.add(obj, "mouseover mouseout", fn);
			
			for (var t = 0; t < types.length; t++ ) {							//����������һ����¼�����
				tns = daRe_typenamespace.exec( types[t] ) || [];				//��ȡ�¼��������ռ�
				type = tns[1];
				namespaces = ( tns[2] || "" ).split( "." ).sort();

				// If event changes its type, use the special event handlers for the changed type
				special = da.event.special[ type ] || {};

				// If selector defined, determine special event api type, otherwise given type
				type = ( selector ? special.delegateType : special.bindType ) || type;

				// Update special based on newly reset type
				special = da.event.special[ type ] || {};

				// handleObj is passed to all event handlers
				handleObj = da.extend({						//�¼���������Ҫ�����ݽṹ��
					type: type,
					origType: tns[1],
					data: data,
					handler: handler,
					guid: handler.guid,
					selector: selector,
					quick: selector && quickParse( selector ),
					namespace: namespaces.join(".")
					
				}, handleObjIn );

				handlers = events[ type ];					//��ȡ��Ӧ�¼����¼���������
				
				if ( !handlers ) {							//�״���ӣ���ʼ���¼���������
					handlers = events[ type ] = [];
					handlers.delegateCount = 0;				//���¼��йܴ��������� ��ʼ��Ϊ0

					//����������¼����� ��da.event.special()�ж���������ֵΪfalse���Ϳ���ֱ����addEventListener()�� attachEvent()���¼�������
					if ( !special.setup || special.setup.call( elem, data, namespaces, eventHandle ) === false ) {
						if ( elem.addEventListener ) {
							elem.addEventListener( type, eventHandle, false );

						} else if ( elem.attachEvent ) {
							elem.attachEvent( "on" + type, eventHandle );
						}
					}
				}

				if ( special.add ) {									//�����¼����ͽṹ�壬�ڲ�������add��������ִ��
					special.add.call( elem, handleObj );

					if ( !handleObj.handler.guid ) {					//����guid
						handleObj.handler.guid = handler.guid;
					}
				}

				if ( selector ) {										//���¼�����ṹ�壬�������
					handlers.splice( handlers.delegateCount++, 0, handleObj );
				}
				else {
					handlers.push( handleObj );
				}

				da.event.global[ type ] = true;					//��da.eventȫ�ֱ�����Ӧ���¼����ʹ��ϱ�ǣ�˵�������¼��������б�ע�ᣬ��ȫ���¼�����ʱ�鿴
			}

			elem = null;										//������Դ�������ڴ�й¶(����IE)
			
		},
	
		//���Ԫ���Ƴ�������һ���¼�
		/*
			elem: Ŀ��Ԫ�ض���
			types: �¼�����
			handler: �Զ����¼��ص�����,ֵΪfalse���������¼���Ӧ
		*/
		remove: function( elem, types, handler, selector, mappedTypes ) {
			var elemData = da.hasData( elem ) && da._data( elem ),	//Ԫ�ػ������ݽṹ��
				tns, namespaces, origType, origCount, type, 
				events,	eventType,									//Ԫ���¼���������
				special, handleObj, handle;

			if ( !elemData || !(events = elemData.events) )	return;	//���¼����棬ֱ�ӷ���
			
			// Once for each type.namespace in types; type may be omitted
			types = da.trim( hoverHack( types || "" ) ).split(" ");		//ͬʱ�Ƴ�����¼����ÿո�" "���ָ����磺da("...").unbind("mouseover mouseout", fn);
			
			for ( var t = 0; t < types.length; t++ ) {
				tns = daRe_typenamespace.exec( types[t] ) || [];		//�����ռ�������¼�����
				type = origType = tns[1];
				namespaces = tns[2];

				// Unbind all events (on this namespace, if provided) for the element
				if ( !type ) {
					for ( type in events ) {							//�ݹ�
						da.event.remove( elem, type + types[ t ], handler, selector, true );
					}
					continue;
				}

				special = da.event.special[ type ] || {};				//�����¼����ʹ���
				type = ( selector? special.delegateType : special.bindType ) || type;
				eventType = events[ type ] || [];
				origCount = eventType.length;
				namespaces = namespaces ? new RegExp("(^|\\.)" + namespaces.split(".").sort().join("\\.(?:.*\\.)?") + "(\\.|$)") : null;

				// Remove matching events
				for ( var j = 0; j < eventType.length; j++ ) {			//ѭ��Ԫ�������Ѱ󶨵��¼�����
					handleObj = eventType[ j ];

					if ( ( mappedTypes || origType === handleObj.origType ) &&
						 ( !handler || handler.guid === handleObj.guid ) &&
						 ( !namespaces || namespaces.test( handleObj.namespace ) ) &&
						 ( !selector || selector === handleObj.selector || selector === "**" && handleObj.selector ) ) {
						eventType.splice( j--, 1 );						//�ҵ�ƥ����¼�������������Ԫ���¼������б����Ƴ�

						if ( handleObj.selector ) {						//ί�η�ʽ delegateCount��Ҫ-1
							eventType.delegateCount--;
						}
						if ( special.remove ) {							//�����¼����ͣ��ṹ���ڶ�����remove����ִ��һ����
							special.remove.call( elem, handleObj );
						}
					}
				}

				if ( eventType.length === 0 && origCount !== eventType.length ) {			//����Ѿ��Ƴ��˸����¼��������д��������ͰѼ����¼�Ҳ�Ƴ�
					if ( !special.teardown || false === special.teardown.call( elem, namespaces ) ) {
						da.removeEvent( elem, type, elemData.handle );
					}

					delete events[ type ];								//�ͷŻ�����
				}
			}

			// Remove the expando if it's no longer used
			if ( da.isEmptyObj( events ) ) {
				handle = elemData.handle;
				if ( handle ) {
					handle.elem = null;
				}

				// removeData also checks for emptiness and clears the expando if empty
				// so use it instead of delete
				da.removeData( elem, [ "events", "handle" ], true );
			}
			
		},

		// Events that are safe to short-circuit if no handlers are attached.
		// Native DOM events should not be added, they may have inline handlers.
		customEvent: {
			"getData": true,
			"setData": true,
			"changeData": true
		},

		//�¼�������( ֧��ͬ�¼�ð�� )
		/*
			event: da.Event���� �򴥷����¼�����event type
			data: �û��Զ������ݴ��룬�����ʽ
			elem: �¼�����Ŀ��Ԫ�ض���
			onlyHandlers: ��ֹ�¼�ð�ݣ����Ҳ�ִ��Ԫ��Ĭ���¼�
		*/
		trigger: function( event, data, elem, onlyHandlers ) {
			if ( elem && (elem.nodeType === 3 || elem.nodeType === 8) ) {		//�ı���ע��Ԫ�����Ǿ�������㻹��ʲô�¼���
				return;
			}
			
			var type = event.type || event,
				namespaces = [],
				exclusive, ontype, special, eventPath, old, cur, handle,
				cache;
			
			// focus/blur morphs to focusin/out; ensure we're not firing them right now
			if ( daRe_focusMorph.test( type + da.event.triggered ) ) {
				return;
			}

			if ( type.indexOf( "!" ) >= 0 ) {					//֧��"click!","evtFn!"����̾��"!"��β��exclusive��ʽ
				// Exclusive events trigger only for the exact event (no namespaces)
				type = type.slice(0, -1);						//ȥ��"!"����
				exclusive = true;								//exclusive��ʽ�򿪣��⽫���addע��������¼��������������ռ�ķ�����ִ��
			}

			if ( type.indexOf( "." ) >= 0 ) {
				// Namespaced trigger; create a regexp to match event type in handle()
				namespaces = type.split(".");
				type = namespaces.shift();
				namespaces.sort();
			}

			if ( (!elem || da.event.customEvent[ type ]) 						//û��ƥ���da�ڲ��Զ����¼�����
			&& !da.event.global[ type ] ) {										//Ҳû��ƥ���ȫ���¼�����
				return;															//ֱ���˳�
			}

			// Caller can pass in an Event, Object, or just an event type string
			event = typeof event === "object" ?
				// jQuery.Event object
				event[ da.expando ] ? event :
				// Object literal
				new da.Event( type, event ) :
				// Just the event type (string)
				new da.Event( type );

			event.type = type;
			event.isTrigger = true;
			event.exclusive = exclusive;
			event.namespace = namespaces.join( "." );
			event.namespace_re = event.namespace? new RegExp("(^|\\.)" + namespaces.join("\\.(?:.*\\.)?") + "(\\.|$)") : null;
			ontype = type.indexOf( ":" ) < 0 ? "on" + type : "";

			// Handle a global trigger
			if ( !elem ) {														//���û��ָ���¼�������Ŀ��Ԫ�ض��󣬾���ȫ���¼��Ĵ���
				// TODO: Stop taunting the data cache; remove global events and always attach to document
				cache = da.cache;												//ֻ��Ҫ����ע������¼����;Ϳ�������
				for ( var i in cache ) {										//������ȫ�ֻ���������ע����¼�������Ԫ�ض��󣬲�����ִ����Ӧ���¼�����
					if ( cache[ i ].events && cache[ i ].events[ type ] ) {
						da.event.trigger( event, data, cache[ i ].handle.elem, true );			//�ݹ��������ִ��
					}
				}
				return;
			}

			// Clean up the event in case it is being reused
			event.result = undefined;											//������ٴδ��������Ȱ�֮ǰ����ִ�еĽ�������
			if ( !event.target ) {
				event.target = elem;
			}

			// Clone any incoming data and prepend the event, creating the handler arg list
			data = data != null ? da.pushArray( data ) : [];					//����д������ݵĻ���ͨ��pushArray����һ������
			data.unshift( event );												//�ڻ��������ײ���ѹ���¼�����

			// Allow special events to draw outside the lines
			special = da.event.special[ type ] || {};
			if ( special.trigger && special.trigger.apply( elem, data ) === false ) {
				return;
			}

			// Determine event propagation path in advance, per W3C events spec (#9951)
			// Bubble up to document, then to window; watch for a global ownerDocument var (#9724)
			eventPath = [[ elem, special.bindType || type ]];
			if ( !onlyHandlers && !special.noBubble && !da.isWin( elem ) ) {

				bubbleType = special.delegateType || type;
				cur = daRe_focusMorph.test( bubbleType + type ) ? elem : elem.parentNode;
				old = null;
				for ( ; cur; cur = cur.parentNode ) {
					eventPath.push([ cur, bubbleType ]);
					old = cur;
				}

				// Only add window if we got to document (e.g., not plain obj or detached DOM)
				if ( old && old === elem.ownerDocument ) {
					eventPath.push([ old.defaultView || old.parentWindow || window, bubbleType ]);
				}
			}
			
			// Fire handlers on the event path
			for ( i = 0; i < eventPath.length && !event.isPropagationStopped(); i++ ) {	//ð�ݴ������׵��¼�����( Ĭ������ һֱ�� Document )
				cur = eventPath[i][0];
				event.type = eventPath[i][1];

				handle = ( da._data( cur, "events" ) || {} )[ event.type ] && da._data( cur, "handle" );	//�ȼٶ�"handle"������һ������,��������¼�����
				if ( handle ) {
					handle.apply( cur, data );						//1. ����ͨ��da.event.add()��ӵ��û��Զ����¼�����,
																	//�����data��������ķ�ʽ�����ֱ���apply()�Ķ������
				}
				// Note that this is a bare JS function and not a jQuery handler
				handle = ontype && cur[ ontype ];					//2. �������ؽű���Ԫ�����ڽű��¼�����, 
																	//�磺obj.onclick=function(){����}; �� <input onclick="fn();" ���� />
				if ( handle && da.acceptData( cur ) && handle.apply( cur, data ) === false ) {		//ִ���¼��������������Ϊfalse������ֹԪ�ص�Ĭ���¼�����
					event.preventDefault();
				}
			}
			event.type = type;

			// If nobody prevented the default action, do it now
			if ( !onlyHandlers && !event.isDefaultPrevented() ) {	//3. ����Ԫ���¼�Ĭ�϶���( Ĭ������ )����:form.submit()

				if ( (!special._default || special._default.apply( elem.ownerDocument, data ) === false) &&	//�������¼� �������¼��жϷ���false 
					!(type === "click" && da.isNodeName( elem, "a" )) && da.acceptData( elem ) ) {			//���ҷǳ�����click�¼� 
																											//���ҷ�����Ԫ�����ͣ����ж������ˣ�����~�Ϳ���ִ����ȥ��
					// Call a native DOM method on the target with the same name name as the event.
					// Can't use an .isFunction() check here because IE6/7 fails that test.
					// Don't do default actions on window, that's where global variables be (#6170)
					// IE<9 dies on focus/blur to hidden element (#1486)
					if ( ontype && elem[ type ] && ((type !== "focus" && type !== "blur") || event.target.offsetWidth !== 0) && !da.isWin( elem ) ) {

						// Don't re-trigger an onFOO event when we call its FOO() method
						old = elem[ ontype ];					//ȡ���¼�����
						
						if ( old ) {							//������ж� �ͽ����ŵ��ÿգ����Ա���ĳЩ�¼�,
							elem[ ontype ] = null;				//���¼�����ִ����Ϸ���֮ǰ�����ٴ��ظ�����( �磺 )
						}

						// Prevent re-triggering of the same event, since we already bubbled it above
						da.event.triggered = type;				//�����Ѵ���ִ���б��
						elem[ type ]();
						da.event.triggered = undefined;			//��������ִ���б��

						if ( old ) {							//��ԭ�¼�����
							elem[ ontype ] = old;					
						}
					}
				}
			}

			return event.result;
			
		},

		simulate: function( type, elem, event, bubble ) {
			// Piggyback on a donor event to simulate a different one.
			// Fake originalEvent to avoid donor's stopPropagation, but if the
			// simulated event prevents default then we do the same on the donor.
			var e = da.extend( new da.Event(), event, {
					type: type,
					isSimulated: true,
					originalEvent: {}
				});
			
			if ( bubble ) {
				da.event.trigger( e, null, elem );
			} 
			else {
				da.event.dispatch.call( elem, e );
			}
			if ( e.isDefaultPrevented() ) {
				event.preventDefault();
			}
		},
	
		//�����¼��������͹��˺ʹ���
		special: {
			ready: {
				setup: da.bindReady							//�ڰ��¼�ǰ��ȷ��ready�¼��Ѿ�����ʼ��
			},

			load: {
				// Prevent triggered image.load events from bubbling to window.load
				noBubble: true
			},

			focus: {
				delegateType: "focusin"
			},
			blur: {
				delegateType: "focusout"
			},

			beforeunload: {
				setup: function( data, namespaces, eventHandle ) {
					// We only want to do this special case on windows
					if ( da.isWin( this ) ) {
						this.onbeforeunload = eventHandle;
					}
				},

				teardown: function( namespaces, eventHandle ) {
					if ( this.onbeforeunload === eventHandle ) {
						this.onbeforeunload = null;
					}
				}
			}
		}
	
	};

	// Create mouseenter/leave events using mouseover/out and event-time checks
	da.each({
		mouseenter: "mouseover",
		mouseleave: "mouseout"
	}, function( orig, fix ) {
		da.event.special[ orig ] = {
			delegateType: fix,
			bindType: fix,
			
			handle: function( event ) {
				var target = this,
					related = event.relatedTarget,
					handleObj = event.handleObj,
					selector = handleObj.selector,
					ret;

				// For mousenter/leave call the handler if related is outside the target.
				// NB: No relatedTarget if the mouse left/entered the browser window
				if ( !related || (related !== target && !da.contains( target, related )) ) {
					event.type = handleObj.origType;
					ret = handleObj.handler.apply( this, arguments );
					event.type = fix;
				}
				return ret;
			}
		};
	});

	// IE submit delegation
	if ( !da.support.submitBubbles ) {
		da.event.special.submit = {
			setup: function() {
				// Only need this for delegated form submit events
				if ( da.isNodeName( this, "form" ) ) {
					return false;
				}

				// Lazy-add a submit handler when a descendant form may potentially be submitted
				da.event.add( this, "click._submit keypress._submit", function( e ) {
					// Node name check avoids a VML-related crash in IE (#9807)
					var elem = e.target,
						form = da.isNodeName( elem, "input" ) || da.isNodeName( elem, "button" ) ? elem.form : undefined;
					if ( form && !form._submit_attached ) {
						jQuery.event.add( form, "submit._submit", function( event ) {
							event._submit_bubble = true;
						});
						form._submit_attached = true;
					}
				});
				// return undefined since we don't need an event listener
			},
			
			postDispatch: function( event ) {
				// If form was submitted by the user, bubble the event up the tree
				if ( event._submit_bubble ) {
					delete event._submit_bubble;
					if ( this.parentNode && !event.isTrigger ) {
						da.event.simulate( "submit", this.parentNode, event, true );
					}
				}
			},

			teardown: function() {
				// Only need this for delegated form submit events
				if ( da.isNodeName( this, "form" ) ) {
					return false;
				}

				// Remove delegated handlers; cleanData eventually reaps submit handlers attached above
				da.event.remove( this, "._submit" );
			}
		};
	}

	// IE change delegation and checkbox/radio fix
	if ( !da.support.changeBubbles ) {
		da.event.special.change = {
			setup: function() {
				if ( daRe_formElems.test( this.nodeName ) ) {
					// IE doesn't fire change on a check/radio until blur; trigger it on click
					// after a propertychange. Eat the blur-change in special.change.handle.
					// This still fires onchange a second time for check/radio after blur.
					if ( this.type === "checkbox" || this.type === "radio" ) {
						da.event.add( this, "propertychange._change", function( event ) {
							if ( event.originalEvent.propertyName === "checked" ) {
								this._just_changed = true;
							}
						});
						da.event.add( this, "click._change", function( event ) {
							if ( this._just_changed && !event.isTrigger ) {
								this._just_changed = false;
								da.event.simulate( "change", this, event, true );
							}
						});
					}
					return false;
				}
				// Delegated event; lazy-add a change handler on descendant inputs
				da.event.add( this, "beforeactivate._change", function( e ) {
					var elem = e.target;

					if ( daRe_formElems.test( elem.nodeName ) && !elem._change_attached ) {
						da.event.add( elem, "change._change", function( event ) {
							if ( this.parentNode && !event.isSimulated && !event.isTrigger ) {
								da.event.simulate( "change", this.parentNode, event, true );
							}
						});
						elem._change_attached = true;
					}
				});
			},

			handle: function( event ) {
				var elem = event.target;

				// Swallow native change events from checkbox/radio, we already triggered them above
				if ( this !== elem || event.isSimulated || event.isTrigger || (elem.type !== "radio" && elem.type !== "checkbox") ) {
					return event.handleObj.handler.apply( this, arguments );
				}
			},

			teardown: function() {
				da.event.remove( this, "._change" );

				return daRe_formElems.test( this.nodeName );
			}
		};
	}

	// Create "bubbling" focus and blur events
	if ( !da.support.focusinBubbles ) {
		da.each({ focus: "focusin", blur: "focusout" }, function( orig, fix ) {

			// Attach a single capturing handler while someone wants focusin/focusout
			var attaches = 0,
				handler = function( event ) {
					da.event.simulate( fix, event.target, da.event.fix( event ), true );
				};

			da.event.special[ fix ] = {
				setup: function() {
					if ( attaches++ === 0 ) {
						document.addEventListener( orig, handler, true );
					}
				},
				teardown: function() {
					if ( --attaches === 0 ) {
						document.removeEventListener( orig, handler, true );
					}
				}
			};
		});
	}

	
	//da������չ�¼���������
	da.fnStruct.extend({
		/**�����¼�
		*/
		on: function( types, objs, data, fn, one/*�ڲ�ʹ��*/ ) {
			var fnUser, type;
			
			//������������
			if ( typeof types === "object" ) {				//( types-Object, selector, data ) �Լ�ֵ�Եķ�ʽ���¼��������磺{"click":funcion(){},"dbclick":funcion(){}}
				if ( typeof objs !== "string" ) { 			//( types-Object, data ) objs��Ϊnull, Ҳ����ѡ�����ַ���
					data = data || objs;					//ǰ��data������λ��
					objs = undefined;
				}
				for ( type in types ) {
					this.on( type, objs, data, types[ type ], one );
				}
				return this;
			}

			if ( data == null && fn == null ) {				//( types, fn )δ����2��3������
				fn = objs;									
				data = objs = undefined;
			} 
			else if ( fn == null ) {
				if ( typeof objs === "string" ) {			//( types, objs, fn )δ����3������
					fn = data;
					data = undefined;
				} 
				else {										//( types, data, fn )δ����2������
					fn = data;
					data = objs;
					objs = undefined;
				}
			}
			
			if ( fn === false ) {							//�¼����δ���
				fn = fnReturnFalse;
			}
			else if ( !fn ) {								//���������������Զ��崦��������������
				return this;
			}

			if ( one === 1 ) {										//һ�����¼�����
				fnUser = fn;
				fn = function( event ) {
					da().off( event );								//��Ϊ��һ�����¼����������Ƴ�Ԫ���ϵ��¼���
					return fnUser.apply( this, arguments );			//��ͨ�����÷�ʽ����ԭ�¼��ص�����
				};
				// Use same guid so caller can remove using fnUser
				//fn.guid = fnUser.guid || ( fnUser.guid = jQuery.guid++ );
			}
			
			return this.each( function() {							//�¼����
				da.event.add( this, types, fn, data, objs );
			});
		},
		
		/**�ر��¼�����
		*/
		off: function( types, objs, fn ) {
			/* TODO:
			if ( types && types.preventDefault && types.handleObj ) {	//( event )����Event����ʽ���Ƴ��¼�
				var handleObj = types.handleObj;
				
				jQuery( types.delegateTarget ).off(
					handleObj.namespace ? handleObj.origType + "." + handleObj.namespace : handleObj.origType,
					handleObj.objs,
					handleObj.handler
				);
				return this;
			}
			 */
			if ( typeof types === "object" ) {						//( types-object [, objs] )�Լ�ֵ�Եķ�ʽ�رռ�������
				for ( var type in types ) {
					this.off( type, objs, types[ type ] );
				}
				return this;
			}
			if ( objs === false || typeof objs === "function" ) {	//( types [, fn] )δ����2������
				fn = objs;
				objs = undefined;
			}
			if ( fn === false ) {									//�¼����δ���
				fn = fnReturnFalse;
			}
			return this.each(function() {
				da.event.remove( this, types, fn, objs );
			});
		},

		bind: function( types, data, fn ) {
			return this.on( types, null, data, fn );
		},
		unbind: function( types, fn ) {
			return this.off( types, null, fn );
		},

		live: function( types, data, fn ) {
			da( this.context ).on( types, this.selector, data, fn );
			return this;
		},
		die: function( types, fn ) {
			da( this.context ).off( types, this.selector || "**", fn );
			return this;
		},

		delegate: function( selector, types, data, fn ) {
			return this.on( types, selector, data, fn );
		},
		undelegate: function( selector, types, fn ) {
			// ( namespace ) or ( selector, types [, fn] )
			return arguments.length == 1? this.off( selector, "**" ) : this.off( types, selector, fn );
		},

		trigger: function( type, data ) {
			return this.each(function() {
				da.event.trigger( type, data, this );
			});
		},
		triggerHandler: function( type, data ) {
			if ( this.dom[0] ) {
				return da.event.trigger( type, data, this.dom[0], true );
			}
		},
	
		hover: function( fnOver, fnOut ) {
			return this.mouseenter( fnOver ).mouseleave( fnOut || fnOver );
		}
	});
	
	da.each([
		"blur","focus","focusin","focusout","load","resize","scroll","unload","click","dblclick",
		"mousedown","mouseup","mousemove","mouseover","mouseout","mouseenter","mouseleave",
		"change","select","submit","keydown","keypress","keyup","error"],
		function( i, name ) {
			// Handle event binding
			da.fnStruct[ name ] = function( data, fn ) {
				if ( fn == null ) {
					fn = data;
					data = null;
				}
		
				return arguments.length > 0 ?
					this.bind( name, data, fn ) :
					this.trigger( name );
			};
		
			if ( da.attrFn ) {
				da.attrFn[ name ] = true;
			}
			
			if ( daRe_keyEvent.test( name ) ) {
				da.event.fixHooks[ name ] = da.event.keyHooks;
			}

			if ( daRe_mouseEvent.test( name ) ) {
				da.event.fixHooks[ name ] = da.event.mouseHooks;
			}
	});

})( da );

/***************** Sizzleѡ���� *****************/
/*!
 * Sizzle CSS Selector Engine
 *  Copyright 2011, The Dojo Foundation
 *  Released under the MIT, BSD, and GPL Licenses.
 *  More information: http://sizzlejs.com/
 */
(function(da){
	var chunker = /((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,
		done = 0,
		toString = Object.prototype.toString,
		hasDuplicate = false,
		baseHasDuplicate = true,
		rBackslash = /\\/g,
		rNonWord = /\W/;
	
	// Here we check if the JavaScript engine is using some sort of
	// optimization where it does not always call our comparision
	// function. If that is the case, discard the hasDuplicate value.
	//   Thus far that includes Google Chrome.
	[0, 0].sort(function() {
		baseHasDuplicate = false;
		return 0;
	});
	
	var Sizzle = function( selector, context, results, seed ) {
		results = results || [];
		context = context || document;
	
		var origContext = context;
		
		if ( !context || context.nodeType !== 1 && context.nodeType !== 9 ) {									//danny ���!context�����ж� 2011-11-7 10:22:37
			return [];
		}
		
		if ( !selector || typeof selector !== "string" ) {
			return results;
		}
	
		var m, set, checkSet, extra, ret, cur, pop, i,
			prune = true,
			contextXML = Sizzle.isXML( context ),
			parts = [],
			soFar = selector;
		
		// Reset the position of the chunker regexp (start from head)
		do {
			chunker.exec( "" );
			m = chunker.exec( soFar );
	
			if ( m ) {
				soFar = m[3];
			
				parts.push( m[1] );
			
				if ( m[2] ) {
					extra = m[3];
					break;
				}
			}
		} while ( m );
	
		if ( parts.length > 1 && origPOS.exec( selector ) ) {
	
			if ( parts.length === 2 && Expr.relative[ parts[0] ] ) {
				set = posProcess( parts[0] + parts[1], context );
	
			} else {
				set = Expr.relative[ parts[0] ] ?
					[ context ] :
					Sizzle( parts.shift(), context );
	
				while ( parts.length ) {
					selector = parts.shift();
	
					if ( Expr.relative[ selector ] ) {
						selector += parts.shift();
					}
					
					set = posProcess( selector, set );
				}
			}
	
		} else {
			// Take a shortcut and set the context if the root selector is an ID
			// (but not if it'll be faster if the inner selector is an ID)
			if ( !seed && parts.length > 1 && context.nodeType === 9 && !contextXML &&
					Expr.match.ID.test(parts[0]) && !Expr.match.ID.test(parts[parts.length - 1]) ) {
	
				ret = Sizzle.find( parts.shift(), context, contextXML );
				context = ret.expr ?
					Sizzle.filter( ret.expr, ret.set )[0] :
					ret.set[0];
			}
	
			if ( context ) {
				ret = seed ?
					{ expr: parts.pop(), set: makeArray(seed) } :
					Sizzle.find( parts.pop(), parts.length === 1 && (parts[0] === "~" || parts[0] === "+") && context.parentNode ? context.parentNode : context, contextXML );
				
				set = ret.expr ?
					Sizzle.filter( ret.expr, ret.set ) :
					ret.set;
	
				if ( parts.length > 0 ) {
					checkSet = makeArray( set );
	
				} else {
					prune = false;
				}
	
				while ( parts.length ) {
					cur = parts.pop();
					pop = cur;
	
					if ( !Expr.relative[ cur ] ) {
						cur = "";
					} else {
						pop = parts.pop();
					}
	
					if ( pop == null ) {
						pop = context;
					}
	
					Expr.relative[ cur ]( checkSet, pop, contextXML );
				}
	
			} else {
				checkSet = parts = [];
			}
		}
	
		if ( !checkSet ) {
			checkSet = set;
		}
	
		if ( !checkSet ) {
			Sizzle.error( cur || selector );
		}
	
		if ( toString.call(checkSet) === "[object Array]" ) {
			if ( !prune ) {
				results.push.apply( results, checkSet );
	
			} else if ( context && context.nodeType === 1 ) {
				for ( i = 0; checkSet[i] != null; i++ ) {
					if ( checkSet[i] && (checkSet[i] === true || checkSet[i].nodeType === 1 && Sizzle.contains(context, checkSet[i])) ) {
						results.push( set[i] );
					}
				}
	
			} else {
				for ( i = 0; checkSet[i] != null; i++ ) {
					if ( checkSet[i] && checkSet[i].nodeType === 1 ) {
						results.push( set[i] );
					}
				}
			}
	
		} else {
			makeArray( checkSet, results );
		}
	
		if ( extra ) {
			Sizzle( extra, origContext, results, seed );
			Sizzle.uniqueSort( results );
		}
	
		return results;
	};
	
	Sizzle.uniqueSort = function( results ) {
		if ( sortOrder ) {
			hasDuplicate = baseHasDuplicate;
			results.sort( sortOrder );
	
			if ( hasDuplicate ) {
				for ( var i = 1; i < results.length; i++ ) {
					if ( results[i] === results[ i - 1 ] ) {
						results.splice( i--, 1 );
					}
				}
			}
		}
	
		return results;
	};
	
	Sizzle.matches = function( expr, set ) {
		return Sizzle( expr, null, null, set );
	};
	
	Sizzle.matchesSelector = function( node, expr ) {
		return Sizzle( expr, null, null, [node] ).length > 0;
	};
	
	Sizzle.find = function( expr, context, isXML ) {
		var set;
	
		if ( !expr ) {
			return [];
		}
	
		for ( var i = 0, l = Expr.order.length; i < l; i++ ) {
			var match,
				type = Expr.order[i];
			
			if ( (match = Expr.leftMatch[ type ].exec( expr )) ) {
				var left = match[1];
				match.splice( 1, 1 );
	
				if ( left.substr( left.length - 1 ) !== "\\" ) {
					match[1] = (match[1] || "").replace( rBackslash, "" );
					set = Expr.find[ type ]( match, context, isXML );
	
					if ( set != null ) {
						expr = expr.replace( Expr.match[ type ], "" );
						break;
					}
				}
			}
		}
	
		if ( !set ) {
			set = typeof context.getElementsByTagName !== "undefined" ?
				context.getElementsByTagName( "*" ) :
				[];
		}
	
		return { set: set, expr: expr };
	};
	
	Sizzle.filter = function( expr, set, inplace, not ) {
		var match, anyFound,
			old = expr,
			result = [],
			curLoop = set,
			isXMLFilter = set && set[0] && Sizzle.isXML( set[0] );
	
		while ( expr && set.length ) {
			for ( var type in Expr.filter ) {
				if ( (match = Expr.leftMatch[ type ].exec( expr )) != null && match[2] ) {
					var found, item,
						filter = Expr.filter[ type ],
						left = match[1];
	
					anyFound = false;
	
					match.splice(1,1);
	
					if ( left.substr( left.length - 1 ) === "\\" ) {
						continue;
					}
	
					if ( curLoop === result ) {
						result = [];
					}
	
					if ( Expr.preFilter[ type ] ) {
						match = Expr.preFilter[ type ]( match, curLoop, inplace, result, not, isXMLFilter );
	
						if ( !match ) {
							anyFound = found = true;
	
						} else if ( match === true ) {
							continue;
						}
					}

					if ( match ) {
						for ( var i = 0; (item = curLoop[i]) != null; i++ ) {
							if ( item ) {
								found = filter( item, match, i, curLoop );
								var pass = not ^ !!found;
	
								if ( inplace && found != null ) {
									if ( pass ) {
										anyFound = true;
	
									} else {
										curLoop[i] = false;
									}
	
								} else if ( pass ) {
									result.push( item );
									anyFound = true;
								}
							}
						}
					}
	
					if ( found !== undefined ) {
						if ( !inplace ) {
							curLoop = result;
						}
	
						expr = expr.replace( Expr.match[ type ], "" );
	
						if ( !anyFound ) {
							return [];
						}
	
						break;
					}
				}
			}
	
			// Improper expression
			if ( expr === old ) {
				if ( anyFound == null ) {
					Sizzle.error( expr );
	
				} else {
					break;
				}
			}
	
			old = expr;
		}
	
		return curLoop;
	};
	
	Sizzle.error = function( msg ) {
		throw "Syntax error, unrecognized expression: " + msg;
	};
	
	var Expr = Sizzle.selectors = {
		order: [ "ID", "NAME", "TAG" ],
	
		match: {
			ID: /#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
			CLASS: /\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
			NAME: /\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,
			ATTR: /\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(?:(['"])(.*?)\3|(#?(?:[\w\u00c0-\uFFFF\-]|\\.)*)|)|)\s*\]/,
			TAG: /^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,
			CHILD: /:(only|nth|last|first)-child(?:\(\s*(even|odd|(?:[+\-]?\d+|(?:[+\-]?\d*)?n\s*(?:[+\-]\s*\d+)?))\s*\))?/,
			POS: /:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,
			PSEUDO: /:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/
		},
	
		leftMatch: {},
	
		attrMap: {
			"class": "className",
			"for": "htmlFor"
		},
	
		attrHandle: {
			href: function( elem ) {
				return elem.getAttribute( "href" );
			},
			type: function( elem ) {
				return elem.getAttribute( "type" );
			}
		},
	
		relative: {
			"+": function(checkSet, part){
				var isPartStr = typeof part === "string",
					isTag = isPartStr && !rNonWord.test( part ),
					isPartStrNotTag = isPartStr && !isTag;
	
				if ( isTag ) {
					part = part.toLowerCase();
				}
	
				for ( var i = 0, l = checkSet.length, elem; i < l; i++ ) {
					if ( (elem = checkSet[i]) ) {
						while ( (elem = elem.previousSibling) && elem.nodeType !== 1 ) {}
	
						checkSet[i] = isPartStrNotTag || elem && elem.nodeName.toLowerCase() === part ?
							elem || false :
							elem === part;
					}
				}
	
				if ( isPartStrNotTag ) {
					Sizzle.filter( part, checkSet, true );
				}
			},
	
			">": function( checkSet, part ) {
				var elem,
					isPartStr = typeof part === "string",
					i = 0,
					l = checkSet.length;
	
				if ( isPartStr && !rNonWord.test( part ) ) {
					part = part.toLowerCase();
	
					for ( ; i < l; i++ ) {
						elem = checkSet[i];
	
						if ( elem ) {
							var parent = elem.parentNode;
							checkSet[i] = parent.nodeName.toLowerCase() === part ? parent : false;
						}
					}
	
				} else {
					for ( ; i < l; i++ ) {
						elem = checkSet[i];
	
						if ( elem ) {
							checkSet[i] = isPartStr ?
								elem.parentNode :
								elem.parentNode === part;
						}
					}
	
					if ( isPartStr ) {
						Sizzle.filter( part, checkSet, true );
					}
				}
			},
	
			"": function(checkSet, part, isXML){
				var nodeCheck,
					doneName = done++,
					checkFn = dirCheck;
	
				if ( typeof part === "string" && !rNonWord.test( part ) ) {
					part = part.toLowerCase();
					nodeCheck = part;
					checkFn = dirNodeCheck;
				}
	
				checkFn( "parentNode", part, doneName, checkSet, nodeCheck, isXML );
			},
	
			"~": function( checkSet, part, isXML ) {
				var nodeCheck,
					doneName = done++,
					checkFn = dirCheck;
	
				if ( typeof part === "string" && !rNonWord.test( part ) ) {
					part = part.toLowerCase();
					nodeCheck = part;
					checkFn = dirNodeCheck;
				}
	
				checkFn( "previousSibling", part, doneName, checkSet, nodeCheck, isXML );
			}
		},
	
		find: {
			ID: function( match, context, isXML ) {
				if ( typeof context.getElementById !== "undefined" && !isXML ) {
					var m = context.getElementById(match[1]);
					// Check parentNode to catch when Blackberry 4.6 returns
					// nodes that are no longer in the document #6963
					return m && m.parentNode ? [m] : [];
				}
			},
	
			NAME: function( match, context ) {
				if ( typeof context.getElementsByName !== "undefined" ) {
					var ret = [],
						results = context.getElementsByName( match[1] );
	
					for ( var i = 0, l = results.length; i < l; i++ ) {
						if ( results[i].getAttribute("name") === match[1] ) {
							ret.push( results[i] );
						}
					}
	
					return ret.length === 0 ? null : ret;
				}
			},
	
			TAG: function( match, context ) {
				if ( typeof context.getElementsByTagName !== "undefined" ) {
					return context.getElementsByTagName( match[1] );
				}
			}
		},
		preFilter: {
			CLASS: function( match, curLoop, inplace, result, not, isXML ) {
				match = " " + match[1].replace( rBackslash, "" ) + " ";
	
				if ( isXML ) {
					return match;
				}
	
				for ( var i = 0, elem; (elem = curLoop[i]) != null; i++ ) {
					if ( elem ) {
						if ( not ^ (elem.className && (" " + elem.className + " ").replace(/[\t\n\r]/g, " ").indexOf(match) >= 0) ) {
							if ( !inplace ) {
								result.push( elem );
							}
	
						} else if ( inplace ) {
							curLoop[i] = false;
						}
					}
				}
	
				return false;
			},
	
			ID: function( match ) {
				return match[1].replace( rBackslash, "" );
			},
	
			TAG: function( match, curLoop ) {
				return match[1].replace( rBackslash, "" ).toLowerCase();
			},
	
			CHILD: function( match ) {
				if ( match[1] === "nth" ) {
					if ( !match[2] ) {
						Sizzle.error( match[0] );
					}
	
					match[2] = match[2].replace(/^\+|\s*/g, '');
	
					// parse equations like 'even', 'odd', '5', '2n', '3n+2', '4n-1', '-n+6'
					var test = /(-?)(\d*)(?:n([+\-]?\d*))?/.exec(
						match[2] === "even" && "2n" || match[2] === "odd" && "2n+1" ||
						!/\D/.test( match[2] ) && "0n+" + match[2] || match[2]);
	
					// calculate the numbers (first)n+(last) including if they are negative
					match[2] = (test[1] + (test[2] || 1)) - 0;
					match[3] = test[3] - 0;
				}
				else if ( match[2] ) {
					Sizzle.error( match[0] );
				}
	
				// TODO: Move to normal caching system
				match[0] = done++;
	
				return match;
			},
	
			ATTR: function( match, curLoop, inplace, result, not, isXML ) {
				var name = match[1] = match[1].replace( rBackslash, "" );
				
				if ( !isXML && Expr.attrMap[name] ) {
					match[1] = Expr.attrMap[name];
				}
	
				// Handle if an un-quoted value was used
				match[4] = ( match[4] || match[5] || "" ).replace( rBackslash, "" );
	
				if ( match[2] === "~=" ) {
					match[4] = " " + match[4] + " ";
				}
	
				return match;
			},
	
			PSEUDO: function( match, curLoop, inplace, result, not ) {
				if ( match[1] === "not" ) {
					// If we're dealing with a complex expression, or a simple one
					if ( ( chunker.exec(match[3]) || "" ).length > 1 || /^\w/.test(match[3]) ) {
						match[3] = Sizzle(match[3], null, null, curLoop);
	
					} else {
						var ret = Sizzle.filter(match[3], curLoop, inplace, true ^ not);
	
						if ( !inplace ) {
							result.push.apply( result, ret );
						}
	
						return false;
					}
	
				} else if ( Expr.match.POS.test( match[0] ) || Expr.match.CHILD.test( match[0] ) ) {
					return true;
				}
				
				return match;
			},
	
			POS: function( match ) {
				match.unshift( true );
	
				return match;
			}
		},
		
		filters: {
			enabled: function( elem ) {
				return elem.disabled === false && elem.type !== "hidden";
			},
	
			disabled: function( elem ) {
				return elem.disabled === true;
			},
	
			checked: function( elem ) {
				return elem.checked === true;
			},
			
			selected: function( elem ) {
				// Accessing this property makes selected-by-default
				// options in Safari work properly
				if ( elem.parentNode ) {
					elem.parentNode.selectedIndex;
				}
				
				return elem.selected === true;
			},
	
			parent: function( elem ) {
				return !!elem.firstChild;
			},
	
			empty: function( elem ) {
				return !elem.firstChild;
			},
	
			has: function( elem, i, match ) {
				return !!Sizzle( match[3], elem ).length;
			},
	
			header: function( elem ) {
				return (/h\d/i).test( elem.nodeName );
			},
	
			text: function( elem ) {
				var attr = elem.getAttribute( "type" ), type = elem.type;
				// IE6 and 7 will map elem.type to 'text' for new HTML5 types (search, etc) 
				// use getAttribute instead to test this case
				return elem.nodeName.toLowerCase() === "input" && "text" === type && ( attr === type || attr === null );
			},
	
			radio: function( elem ) {
				return elem.nodeName.toLowerCase() === "input" && "radio" === elem.type;
			},
	
			checkbox: function( elem ) {
				return elem.nodeName.toLowerCase() === "input" && "checkbox" === elem.type;
			},
	
			file: function( elem ) {
				return elem.nodeName.toLowerCase() === "input" && "file" === elem.type;
			},
	
			password: function( elem ) {
				return elem.nodeName.toLowerCase() === "input" && "password" === elem.type;
			},
	
			submit: function( elem ) {
				var name = elem.nodeName.toLowerCase();
				return (name === "input" || name === "button") && "submit" === elem.type;
			},
	
			image: function( elem ) {
				return elem.nodeName.toLowerCase() === "input" && "image" === elem.type;
			},
	
			reset: function( elem ) {
				var name = elem.nodeName.toLowerCase();
				return (name === "input" || name === "button") && "reset" === elem.type;
			},
	
			button: function( elem ) {
				var name = elem.nodeName.toLowerCase();
				return name === "input" && "button" === elem.type || name === "button";
			},
	
			input: function( elem ) {
				return (/input|select|textarea|button/i).test( elem.nodeName );
			},
	
			focus: function( elem ) {
				return elem === elem.ownerDocument.activeElement;
			}
		},
		setFilters: {
			first: function( elem, i ) {
				return i === 0;
			},
	
			last: function( elem, i, match, array ) {
				return i === array.length - 1;
			},
	
			even: function( elem, i ) {
				return i % 2 === 0;
			},
	
			odd: function( elem, i ) {
				return i % 2 === 1;
			},
	
			lt: function( elem, i, match ) {
				return i < match[3] - 0;
			},
	
			gt: function( elem, i, match ) {
				return i > match[3] - 0;
			},
	
			nth: function( elem, i, match ) {
				return match[3] - 0 === i;
			},
	
			eq: function( elem, i, match ) {
				return match[3] - 0 === i;
			}
		},
		filter: {
			PSEUDO: function( elem, match, i, array ) {
				var name = match[1],
					filter = Expr.filters[ name ];
	
				if ( filter ) {
					return filter( elem, i, match, array );
	
				} else if ( name === "contains" ) {
					return (elem.textContent || elem.innerText || Sizzle.getText([ elem ]) || "").indexOf(match[3]) >= 0;
	
				} else if ( name === "not" ) {
					var not = match[3];
	
					for ( var j = 0, l = not.length; j < l; j++ ) {
						if ( not[j] === elem ) {
							return false;
						}
					}
	
					return true;
	
				} else {
					Sizzle.error( name );
				}
			},
	
			CHILD: function( elem, match ) {
				var type = match[1],
					node = elem;
	
				switch ( type ) {
					case "only":
					case "first":
						while ( (node = node.previousSibling) )	 {
							if ( node.nodeType === 1 ) { 
								return false; 
							}
						}
	
						if ( type === "first" ) { 
							return true; 
						}
	
						node = elem;
	
					case "last":
						while ( (node = node.nextSibling) )	 {
							if ( node.nodeType === 1 ) { 
								return false; 
							}
						}
	
						return true;
	
					case "nth":
						var first = match[2],
							last = match[3];
	
						if ( first === 1 && last === 0 ) {
							return true;
						}
						
						var doneName = match[0],
							parent = elem.parentNode;
		
						if ( parent && (parent.sizcache !== doneName || !elem.nodeIndex) ) {
							var count = 0;
							
							for ( node = parent.firstChild; node; node = node.nextSibling ) {
								if ( node.nodeType === 1 ) {
									node.nodeIndex = ++count;
								}
							} 
	
							parent.sizcache = doneName;
						}
						
						var diff = elem.nodeIndex - last;
	
						if ( first === 0 ) {
							return diff === 0;
	
						} else {
							return ( diff % first === 0 && diff / first >= 0 );
						}
				}
			},
	
			ID: function( elem, match ) {
				return elem.nodeType === 1 && elem.getAttribute("id") === match;
			},
	
			TAG: function( elem, match ) {
				return (match === "*" && elem.nodeType === 1) || elem.nodeName.toLowerCase() === match;
			},
			
			CLASS: function( elem, match ) {
				return (" " + (elem.className || elem.getAttribute("class")) + " ")
					.indexOf( match ) > -1;
			},
	
			ATTR: function( elem, match ) {
				var name = match[1],
					result = Expr.attrHandle[ name ] ?
						Expr.attrHandle[ name ]( elem ) :
						elem[ name ] != null ?
							elem[ name ] :
							elem.getAttribute( name ),
					value = result + "",
					type = match[2],
					check = match[4];
	
				return result == null ?
					type === "!=" :
					type === "=" ?
					value === check :
					type === "*=" ?
					value.indexOf(check) >= 0 :
					type === "~=" ?
					(" " + value + " ").indexOf(check) >= 0 :
					!check ?
					value && result !== false :
					type === "!=" ?
					value !== check :
					type === "^=" ?
					value.indexOf(check) === 0 :
					type === "$=" ?
					value.substr(value.length - check.length) === check :
					type === "|=" ?
					value === check || value.substr(0, check.length + 1) === check + "-" :
					false;
			},
	
			POS: function( elem, match, i, array ) {
				var name = match[2],
					filter = Expr.setFilters[ name ];
	
				if ( filter ) {
					return filter( elem, i, match, array );
				}
			}
		}
	};
	
	var origPOS = Expr.match.POS,
		fescape = function(all, num){
			return "\\" + (num - 0 + 1);
		};
	
	for ( var type in Expr.match ) {
		Expr.match[ type ] = new RegExp( Expr.match[ type ].source + (/(?![^\[]*\])(?![^\(]*\))/.source) );
		Expr.leftMatch[ type ] = new RegExp( /(^(?:.|\r|\n)*?)/.source + Expr.match[ type ].source.replace(/\\(\d+)/g, fescape) );
	}
	
	var makeArray = function( array, results ) {
		array = Array.prototype.slice.call( array, 0 );
	
		if ( results ) {
			results.push.apply( results, array );
			return results;
		}
		
		return array;
	};
	
	// Perform a simple check to determine if the browser is capable of
	// converting a NodeList to an array using builtin methods.
	// Also verifies that the returned array holds DOM nodes
	// (which is not the case in the Blackberry browser)
	try {
		Array.prototype.slice.call( document.documentElement.childNodes, 0 )[0].nodeType;
	
	// Provide a fallback method if it does not work
	} catch( e ) {
		makeArray = function( array, results ) {
			var i = 0,
				ret = results || [];
	
			if ( toString.call(array) === "[object Array]" ) {
				Array.prototype.push.apply( ret, array );
	
			} else {
				if ( typeof array.length === "number" ) {
					for ( var l = array.length; i < l; i++ ) {
						ret.push( array[i] );
					}
	
				} else {
					for ( ; array[i]; i++ ) {
						ret.push( array[i] );
					}
				}
			}
	
			return ret;
		};
	}
	
	var sortOrder, siblingCheck;
	
	if ( document.documentElement.compareDocumentPosition ) {
		sortOrder = function( a, b ) {
			if ( a === b ) {
				hasDuplicate = true;
				return 0;
			}
	
			if ( !a.compareDocumentPosition || !b.compareDocumentPosition ) {
				return a.compareDocumentPosition ? -1 : 1;
			}
	
			return a.compareDocumentPosition(b) & 4 ? -1 : 1;
		};
	
	} else {
		sortOrder = function( a, b ) {
			// The nodes are identical, we can exit early
			if ( a === b ) {
				hasDuplicate = true;
				return 0;
	
			// Fallback to using sourceIndex (in IE) if it's available on both nodes
			} else if ( a.sourceIndex && b.sourceIndex ) {
				return a.sourceIndex - b.sourceIndex;
			}
	
			var al, bl,
				ap = [],
				bp = [],
				aup = a.parentNode,
				bup = b.parentNode,
				cur = aup;
	
			// If the nodes are siblings (or identical) we can do a quick check
			if ( aup === bup ) {
				return siblingCheck( a, b );
	
			// If no parents were found then the nodes are disconnected
			} else if ( !aup ) {
				return -1;
	
			} else if ( !bup ) {
				return 1;
			}
	
			// Otherwise they're somewhere else in the tree so we need
			// to build up a full list of the parentNodes for comparison
			while ( cur ) {
				ap.unshift( cur );
				cur = cur.parentNode;
			}
	
			cur = bup;
	
			while ( cur ) {
				bp.unshift( cur );
				cur = cur.parentNode;
			}
	
			al = ap.length;
			bl = bp.length;
	
			// Start walking down the tree looking for a discrepancy
			for ( var i = 0; i < al && i < bl; i++ ) {
				if ( ap[i] !== bp[i] ) {
					return siblingCheck( ap[i], bp[i] );
				}
			}
	
			// We ended someplace up the tree so do a sibling check
			return i === al ?
				siblingCheck( a, bp[i], -1 ) :
				siblingCheck( ap[i], b, 1 );
		};
	
		siblingCheck = function( a, b, ret ) {
			if ( a === b ) {
				return ret;
			}
	
			var cur = a.nextSibling;
	
			while ( cur ) {
				if ( cur === b ) {
					return -1;
				}
	
				cur = cur.nextSibling;
			}
	
			return 1;
		};
	}
	
	// Utility function for retreiving the text value of an array of DOM nodes
	Sizzle.getText = function( elems ) {
		var ret = "", elem;
	
		for ( var i = 0; elems[i]; i++ ) {
			elem = elems[i];
	
			// Get the text from text nodes and CDATA nodes
			if ( elem.nodeType === 3 || elem.nodeType === 4 ) {
				ret += elem.nodeValue;
	
			// Traverse everything else, except comment nodes
			} else if ( elem.nodeType !== 8 ) {
				ret += Sizzle.getText( elem.childNodes );
			}
		}
	
		return ret;
	};
	
	// Check to see if the browser returns elements by name when
	// querying by getElementById (and provide a workaround)
	(function(){
		// We're going to inject a fake input element with a specified name
		var form = document.createElement("div"),
			id = "script" + (new Date()).getTime(),
			root = document.documentElement;
	
		form.innerHTML = "<a name='" + id + "'/>";
	
		// Inject it into the root element, check its status, and remove it quickly
		root.insertBefore( form, root.firstChild );
	
		// The workaround has to do additional checks after a getElementById
		// Which slows things down for other browsers (hence the branching)
		if ( document.getElementById( id ) ) {
			Expr.find.ID = function( match, context, isXML ) {
				if ( typeof context.getElementById !== "undefined" && !isXML ) {
					var m = context.getElementById(match[1]);
	
					return m ?
						m.id === match[1] || typeof m.getAttributeNode !== "undefined" && m.getAttributeNode("id").nodeValue === match[1] ?
							[m] :
							undefined :
						[];
				}
			};
	
			Expr.filter.ID = function( elem, match ) {
				var node = typeof elem.getAttributeNode !== "undefined" && elem.getAttributeNode("id");
	
				return elem.nodeType === 1 && node && node.nodeValue === match;
			};
		}
	
		root.removeChild( form );
	
		// release memory in IE
		root = form = null;
	})();
	
	(function(){
		// Check to see if the browser returns only elements
		// when doing getElementsByTagName("*")
	
		// Create a fake element
		var div = document.createElement("div");
		div.appendChild( document.createComment("") );
	
		// Make sure no comments are found
		if ( div.getElementsByTagName("*").length > 0 ) {
			Expr.find.TAG = function( match, context ) {
				var results = context.getElementsByTagName( match[1] );
	
				// Filter out possible comments
				if ( match[1] === "*" ) {
					var tmp = [];
	
					for ( var i = 0; results[i]; i++ ) {
						if ( results[i].nodeType === 1 ) {
							tmp.push( results[i] );
						}
					}
	
					results = tmp;
				}
	
				return results;
			};
		}
	
		// Check to see if an attribute returns normalized href attributes
		div.innerHTML = "<a href='#'></a>";
	
		if ( div.firstChild && typeof div.firstChild.getAttribute !== "undefined" &&
				div.firstChild.getAttribute("href") !== "#" ) {
	
			Expr.attrHandle.href = function( elem ) {
				return elem.getAttribute( "href", 2 );
			};
		}
	
		// release memory in IE
		div = null;
	})();
	
	if ( document.querySelectorAll ) {
		(function(){
			var oldSizzle = Sizzle,
				div = document.createElement("div"),
				id = "__sizzle__";
	
			div.innerHTML = "<p class='TEST'></p>";
	
			// Safari can't handle uppercase or unicode characters when
			// in quirks mode.
			if ( div.querySelectorAll && div.querySelectorAll(".TEST").length === 0 ) {
				return;
			}
		
			Sizzle = function( query, context, extra, seed ) {
				context = context || document;
	
				// Only use querySelectorAll on non-XML documents
				// (ID selectors don't work in non-HTML documents)
				if ( !seed && !Sizzle.isXML(context) ) {
					// See if we find a selector to speed up
					var match = /^(\w+$)|^\.([\w\-]+$)|^#([\w\-]+$)/.exec( query );
					
					if ( match && (context.nodeType === 1 || context.nodeType === 9) ) {
						// Speed-up: Sizzle("TAG")
						if ( match[1] ) {
							return makeArray( context.getElementsByTagName( query ), extra );
						
						// Speed-up: Sizzle(".CLASS")
						} else if ( match[2] && Expr.find.CLASS && context.getElementsByClassName ) {
							return makeArray( context.getElementsByClassName( match[2] ), extra );
						}
					}
					
					if ( context.nodeType === 9 ) {
						// Speed-up: Sizzle("body")
						// The body element only exists once, optimize finding it
						if ( query === "body" && context.body ) {
							return makeArray( [ context.body ], extra );
							
						// Speed-up: Sizzle("#ID")
						} else if ( match && match[3] ) {
							var elem = context.getElementById( match[3] );
	
							// Check parentNode to catch when Blackberry 4.6 returns
							// nodes that are no longer in the document #6963
							if ( elem && elem.parentNode ) {
								// Handle the case where IE and Opera return items
								// by name instead of ID
								if ( elem.id === match[3] ) {
									return makeArray( [ elem ], extra );
								}
								
							} else {
								return makeArray( [], extra );
							}
						}
						
						try {
							return makeArray( context.querySelectorAll(query), extra );
						} catch(qsaError) {}
	
					// qSA works strangely on Element-rooted queries
					// We can work around this by specifying an extra ID on the root
					// and working up from there (Thanks to Andrew Dupont for the technique)
					// IE 8 doesn't work on object elements
					} else if ( context.nodeType === 1 && context.nodeName.toLowerCase() !== "object" ) {
						var oldContext = context,
							old = context.getAttribute( "id" ),
							nid = old || id,
							hasParent = context.parentNode,
							relativeHierarchySelector = /^\s*[+~]/.test( query );
	
						if ( !old ) {
							context.setAttribute( "id", nid );
						} else {
							nid = nid.replace( /'/g, "\\$&" );
						}
						if ( relativeHierarchySelector && hasParent ) {
							context = context.parentNode;
						}
	
						try {
							if ( !relativeHierarchySelector || hasParent ) {
								return makeArray( context.querySelectorAll( "[id='" + nid + "'] " + query ), extra );
							}
	
						} catch(pseudoError) {
						} finally {
							if ( !old ) {
								oldContext.removeAttribute( "id" );
							}
						}
					}
				}
			
				return oldSizzle(query, context, extra, seed);
			};
	
			for ( var prop in oldSizzle ) {
				Sizzle[ prop ] = oldSizzle[ prop ];
			}
	
			// release memory in IE
			div = null;
		})();
	}
	
	(function(){
		var html = document.documentElement,
			matches = html.matchesSelector || html.mozMatchesSelector || html.webkitMatchesSelector || html.msMatchesSelector;
	
		if ( matches ) {
			// Check to see if it's possible to do matchesSelector
			// on a disconnected node (IE 9 fails this)
			var disconnectedMatch = !matches.call( document.createElement( "div" ), "div" ),
				pseudoWorks = false;
	
			try {
				// This should fail with an exception
				// Gecko does not error, returns false instead
				matches.call( document.documentElement, "[test!='']:sizzle" );
		
			} catch( pseudoError ) {
				pseudoWorks = true;
			}
	
			Sizzle.matchesSelector = function( node, expr ) {
				// Make sure that attribute selectors are quoted
				expr = expr.replace(/\=\s*([^'"\]]*)\s*\]/g, "='$1']");
	
				if ( !Sizzle.isXML( node ) ) {
					try { 
						if ( pseudoWorks || !Expr.match.PSEUDO.test( expr ) && !/!=/.test( expr ) ) {
							var ret = matches.call( node, expr );
	
							// IE 9's matchesSelector returns false on disconnected nodes
							if ( ret || !disconnectedMatch ||
									// As well, disconnected nodes are said to be in a document
									// fragment in IE 9, so check for that
									node.document && node.document.nodeType !== 11 ) {
								return ret;
							}
						}
					} catch(e) {}
				}
	
				return Sizzle(expr, null, null, [node]).length > 0;
			};
		}
	})();
	
	(function(){
		var div = document.createElement("div");
	
		div.innerHTML = "<div class='test e'></div><div class='test'></div>";
	
		// Opera can't find a second classname (in 9.6)
		// Also, make sure that getElementsByClassName actually exists
		if ( !div.getElementsByClassName || div.getElementsByClassName("e").length === 0 ) {
			return;
		}
	
		// Safari caches class attributes, doesn't catch changes (in 3.2)
		div.lastChild.className = "e";
	
		if ( div.getElementsByClassName("e").length === 1 ) {
			return;
		}
		
		Expr.order.splice(1, 0, "CLASS");
		Expr.find.CLASS = function( match, context, isXML ) {
			if ( typeof context.getElementsByClassName !== "undefined" && !isXML ) {
				return context.getElementsByClassName(match[1]);
			}
		};
	
		// release memory in IE
		div = null;
	})();
	
	function dirNodeCheck( dir, cur, doneName, checkSet, nodeCheck, isXML ) {
		for ( var i = 0, l = checkSet.length; i < l; i++ ) {
			var elem = checkSet[i];
	
			if ( elem ) {
				var match = false;
	
				elem = elem[dir];
	
				while ( elem ) {
					if ( elem.sizcache === doneName ) {
						match = checkSet[elem.sizset];
						break;
					}
	
					if ( elem.nodeType === 1 && !isXML ){
						elem.sizcache = doneName;
						elem.sizset = i;
					}
	
					if ( elem.nodeName.toLowerCase() === cur ) {
						match = elem;
						break;
					}
	
					elem = elem[dir];
				}
	
				checkSet[i] = match;
			}
		}
	}
	
	function dirCheck( dir, cur, doneName, checkSet, nodeCheck, isXML ) {
		for ( var i = 0, l = checkSet.length; i < l; i++ ) {
			var elem = checkSet[i];
	
			if ( elem ) {
				var match = false;
				
				elem = elem[dir];
	
				while ( elem ) {
					if ( elem.sizcache === doneName ) {
						match = checkSet[elem.sizset];
						break;
					}
	
					if ( elem.nodeType === 1 ) {
						if ( !isXML ) {
							elem.sizcache = doneName;
							elem.sizset = i;
						}
	
						if ( typeof cur !== "string" ) {
							if ( elem === cur ) {
								match = true;
								break;
							}
	
						} else if ( Sizzle.filter( cur, [elem] ).length > 0 ) {
							match = elem;
							break;
						}
					}
	
					elem = elem[dir];
				}
	
				checkSet[i] = match;
			}
		}
	}
	
	if ( document.documentElement.contains ) {
		Sizzle.contains = function( a, b ) {
			return a !== b && (a.contains ? a.contains(b) : true);
		};
	
	} else if ( document.documentElement.compareDocumentPosition ) {
		Sizzle.contains = function( a, b ) {
			return !!(a.compareDocumentPosition(b) & 16);
		};
	
	} else {
		Sizzle.contains = function() {
			return false;
		};
	}
	
	Sizzle.isXML = function( elem ) {
		// documentElement is verified for cases where it doesn't yet exist
		// (such as loading iframes in IE - #4833) 
		var documentElement = (elem ? elem.ownerDocument || elem : 0).documentElement;
	
		return documentElement ? documentElement.nodeName !== "HTML" : false;
	};
	
	var posProcess = function( selector, context ) {
		var match,
			tmpSet = [],
			later = "",
			root = context.nodeType ? [context] : context;
	
		// Position selectors must be done after the filter
		// And so must :not(positional) so we move all PSEUDOs to the end
		while ( (match = Expr.match.PSEUDO.exec( selector )) ) {
			later += match[0];
			selector = selector.replace( Expr.match.PSEUDO, "" );
		}
	
		selector = Expr.relative[selector] ? selector + "*" : selector;
	
		for ( var i = 0, l = root.length; i < l; i++ ) {
			Sizzle( selector, root[i], tmpSet );
		}
	
		return Sizzle.filter( later, tmpSet );
	};
	
	//****************** ����Sizzleѡ���� ***********************/
	// EXPOSE
	//window.Sizzle = Sizzle;
	da.find = Sizzle;
	da.expr = Sizzle.selectors;
	da.expr[":"] = da.expr.filters;
	da.unique = Sizzle.uniqueSort;
	da.text = Sizzle.getText;
	da.isXMLDoc = Sizzle.isXML;
	da.contains = Sizzle.contains;
	//****************** ����Sizzleѡ���� ***********************/
})(da);

/***************** Sizzleѡ���� ��չ *****************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: Sizzleѡ���� ��չ�ӿں���
	version: 1.0.0
*/
(function(da){
	if ( da.expr && da.expr.filters ) {
		/**Sizzleѡ������չhidden����ֵ�ж�
		*/
		da.expr.filters.hidden = function( elem ) {
			var width = elem.offsetWidth,
				height = elem.offsetHeight;

			return (width === 0 && height === 0) || (!da.support.reliableHiddenOffsets && (elem.style.display || da.curCSS( elem, "display" )) === "none");
		};

		/**Sizzleѡ������չvisible����ֵ�ж�
		*/
		da.expr.filters.visible = function( elem ) {
			return !da.expr.filters.hidden( elem );
			
		};
	}

	
	
var daRe_until = /Until$/,
	daRe_parentsprev = /^(?:parents|prevUntil|prevAll)/,
	// Note: This RegExp should be improved, or likely pulled from Sizzle
	daRe_multiselector = /,/,
	daRe_isSimple = /^.[^:#\[\.,]*$/,
	daRe_POS = da.expr.match.POS,
	
	// methods guaranteed to produce a unique set when starting from a unique set
	guaranteedUnique = {
		children: true,
		contents: true,
		next: true,
		prev: true 
	};
	
	
	//Ԫ����ѡ���� //Implement the identical functionality for filter and not
	/*
		elements: Ԫ�ؼ���
		qualifier: ��������
		keep: ????????
	*/
	function winnow( elements, qualifier, keep ) {
	
		// Can't pass null or undefined to indexOf in Firefox 4
		// Set to 0 to skip string check
		qualifier = qualifier || 0;
	
		if ( da.isFunction( qualifier ) ) {												//�������������function
			return da.grep(elements, function( elem, i ) {					//ͨ��da.grep()�����������õ����˺�ĺϸ�Ԫ�ؼ���
				var retVal = !!qualifier.call( elem, i, elem );
				return retVal === keep;
			});
	
		}
		else if ( qualifier.nodeType ) {													//������������ǽڵ�Ԫ�ض���
			return da.grep(elements, function( elem, i ) {
				return (elem === qualifier) === keep;
			});
	
		} 
		else if ( typeof qualifier === "string" ) {								//�������������Sizzleѡ�����ַ���
			var filtered = da.grep(elements, function( elem ) {			//ѡ��Sizzle�ɲ�����Ԫ�ض���
				return elem.nodeType === 1;
			});
	
			if ( daRe_isSimple.test( qualifier ) ) {								//???????????
				return da.filter(qualifier, filtered, !keep);
			}
			else {
				qualifier = da.filter( qualifier, filtered );
			}
		}
	
		return da.grep(elements, function( elem, i ) {
			return ( 0 <= da.isInArray( elem, qualifier ) ) === keep;
		});
	}
	

	da.extend({
		//���˺���
		/*
			expr: ѡ�������ʽ
			elems: Ԫ�ؼ���
			not: �Ƿ�ȡ��(ѡ�������ʽ)
		*/
		filter: function( expr, elems, not ) {
			if ( not ) {							//�����Ҫȡ�������ʽ����ȡ��ǰ׺
				expr = ":not(" + expr + ")";
			}
			
			return elems.length === 1 ?
				da.find.matchesSelector(elems[0], expr) ? [ elems[0] ] : [] :
				da.find.matches(expr, elems);
		},

		dir: function( elem, dir, until ) {
			var matched = [],
				cur = elem[ dir ];

			while ( cur && cur.nodeType !== 9 && (until === undefined || cur.nodeType !== 1 || !da( cur ).is( until )) ) {
				if ( cur.nodeType === 1 ) {
					matched.push( cur );
				}
				cur = cur[dir];
			}
			return matched;
		},

		nth: function( cur, result, dir, elem ) {
			result = result || 1;
			var num = 0;

			for ( ; cur; cur = cur[dir] ) {
				if ( cur.nodeType === 1 && ++num === result ) {
					break;
				}
			}

			return cur;
		},

		sibling: function( n, elem ) {
			var r = [];

			for ( ; n; n = n.nextSibling ) {
				if ( n.nodeType === 1 && n !== elem ) {
					r.push( n );
				}
			}

			return r;
		}
	});

	da.fnStruct.extend({
		/**Ԫ��ѡ�������˺���
		*/
		filter: function( selector ) {
			return this.pushStack( winnow(this.dom, selector, true), "filter", selector );
		},
		
		/**Ԫ��ѡ�����жϺ���
		*/
		is: function( selector ) {
			return !!selector && ( typeof selector === "string" ?
				daRe_POS.test( selector ) ?
					da( selector, this.context ).index( this.dom[0] ) >= 0 :
					da.filter( selector, this.dom ).length > 0 :
				this.filter( selector ).length > 0 );
		},
		
		//da�����DOMѡ��������
		/*
			selector: ѡ�����ַ���
		*/
		find: function( selector ) {
			var self = this, i, l;
			
			if ( typeof selector !== "string" ) {													//selector�����ַ���
				return da( selector ).filter(function() {
					for ( i=0, l=self.length; i < l; i++ ) {
						if ( da.contains( self.dom[ i ], this ) ) {
							return true;
						}
					}
					
				});
			}
		
			var ret = this.pushStack( "", "find", selector ),							//selector������ѡ�����ַ���
					len, n, r;
		
			for ( i = 0, l = this.dom.length; i < l; i++ ) {
				len = ret.dom.length;
				da.find( selector, this.dom[i], ret.dom );
	
				if ( i > 0 ) {
					// Make sure that the results are unique
					for ( n = len; n < ret.dom.length; n++ ) {										//��֤ret���ص�Ԫ�ؼ�ÿһ��������Ψһ��
						for ( r = 0; r < len; r++ ) {
							if ( ret.dom[r] === ret.dom[n] ) {
								ret.dom.splice(n--, 1);
								break;
							}
						}
					}
				}
			}
	
			return ret;
		},
		
		// Determine the position of an element within
		// the matched set of elements
		index: function( elem ) {
			// No argument, return index in parent
			if ( !elem ) {
				return ( this.dom[0] && this.dom[0].parentNode ) ? this.prevAll().length : -1;
			}

			// index in selector
			if ( typeof elem === "string" ) {
				return da.inArray( this.dom[0], da( elem ).dom );
			}

			// Locate the position of the desired element
			return da.inArray(
				// If it receives a jQuery object, the first element is used
				elem instanceof da ? elem.dom[0] : elem, this );
		}
	});

	da.each({
		parent: function( elem ) {
			var parent = elem.parentNode;
			return parent && parent.nodeType !== 11 ? parent : null;
		},
		parents: function( elem ) {
			return da.dir( elem, "parentNode" );
		},
		parentsUntil: function( elem, i, until ) {
			return da.dir( elem, "parentNode", until );
		},
		next: function( elem ) {
			return da.nth( elem, 2, "nextSibling" );
		},
		prev: function( elem ) {
			return da.nth( elem, 2, "previousSibling" );
		},
		nextAll: function( elem ) {
			return da.dir( elem, "nextSibling" );
		},
		prevAll: function( elem ) {
			return da.dir( elem, "previousSibling" );
		},
		nextUntil: function( elem, i, until ) {
			return da.dir( elem, "nextSibling", until );
		},
		prevUntil: function( elem, i, until ) {
			return da.dir( elem, "previousSibling", until );
		},
		siblings: function( elem ) {
			return da.sibling( elem.parentNode.firstChild, elem );
		},
		children: function( elem ) {
			return da.sibling( elem.firstChild );
		},
		contents: function( elem ) {
			return da.isNodeName( elem, "iframe" ) ?
				elem.contentDocument || elem.contentWindow.document :
				da.pushArray( elem.childNodes );
		}
	}, 
	function( name, fn ) {
		da.fnStruct[ name ] = function( until, selector ) {
			var ret = da.map( this.dom, fn, until ),
				// The variable 'args' was introduced in
				// https://github.com/jquery/jquery/commit/52a0238
				// to work around a bug in Chrome 10 (Dev) and should be removed when the bug is fixed.
				// http://code.google.com/p/v8/issues/detail?id=1050
				args = [].slice.call(arguments);
	
			if ( !daRe_until.test( name ) ) {
				selector = until;
			}
	
			if ( selector && typeof selector === "string" ) {
				ret = da.filter( selector, ret );
			}
	
			ret = this.length > 1 && !guaranteedUnique[ name ] ? da.unique( ret ) : ret;
	
			if ( (this.length > 1 || daRe_multiselector.test( selector )) && daRe_parentsprev.test( name ) ) {
				ret = ret.reverse();
			}
	
			return this.pushStack( ret, name, args.join(",") );
		};
	});

})(da);

/***************** Ԫ�ز��� *****************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: Elements ���������� ���Ĵ���
	version: 1.0.0
*/
(function(da){
	var daRe_inlineDA = / da\d+="(?:\d+|null)"/g,
		daRe_leadingWhitespace = /^\s+/,							//ƥ����ǰ�οո���ַ���
		daRe_html = /<|&#?\w+;/,
		daRe_xhtmlTag = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig,
		daRe_tagName = /<([\w:]+)/,
		daRe_tbody = /<tbody/i,										//�ж��Ƿ���tbody��ǩ
		daRe_scriptType = /\/(java|ecma)script/i,					//�ж��Ƿ��нŲ���ǩ
		daRe_cleanScript = /^\s*<!(?:\[CDATA\[|\-\-)|[\]\-]{2}>\s*$/g,
		
		daRe_nocache = /<(?:script|object|embed|option|style)/i,	//?????????
		daRe_checked = /checked\s*(?:[^=]|=\s*.checked.)/i,
		
		nodeNames = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|" +
		"header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
		daRe_noshimcache = new RegExp("<(?:" + nodeNames + ")[\\s/>]", "i"),

		
		daWrapMap = {												//Ԫ�ذ���ӳ���
			option: [ 1, "<select multiple='multiple'>", "</select>" ],
			legend: [ 1, "<fieldset>", "</fieldset>" ],
			thead: [ 1, "<table>", "</table>" ],
			tr: [ 2, "<table><tbody>", "</tbody></table>" ],
			td: [ 3, "<table><tbody><tr>", "</tr></tbody></table>" ],
			col: [ 2, "<table><tbody></tbody><colgroup>", "</colgroup></table>" ],
			area: [ 1, "<map>", "</map>" ],
			_default: [ 0, "", "" ]
		};
	
	daWrapMap.optgroup = daWrapMap.option;
	daWrapMap.tbody = daWrapMap.tfoot = daWrapMap.colgroup = daWrapMap.caption = daWrapMap.thead;
	daWrapMap.th = daWrapMap.td;

	if ( !da.support.htmlSerialize ) {											//IE���������Ĵ��л�link��script��ǩԪ��
		daWrapMap._default = [ 1, "div<div>", "</div>" ];
	}

	
	da.fnStruct.extend({
		text: function( text ) {
			if ( da.isFunction(text) ) {
				return this.each(function(i) {
					var self = da( this );
					self.text( text.call(this, i, self.text()) );
				});
			}
	
			if ( "object" !== typeof text && undefined !== text ) {
				return this.empty().append( (this.dom[0] && this.dom[0].ownerDocument || document).createTextNode( text ) );
			}
	
			return da.text( this.dom );
		},
	
		empty: function() {
			for ( var i = 0, elem; (elem = this.dom[i]) != null; i++ ) {
				// Remove element nodes and prevent memory leaks
				if ( elem.nodeType === 1 ) {
					da.cleanData( elem.getElementsByTagName("*") );
				}
	
				// Remove any remaining nodes
				while ( elem.firstChild ) {
					elem.removeChild( elem.firstChild );
				}
			}
	
			return this;
		},

		append: function() {
			return this.domManip(arguments, true, function( elem ) {
				if ( this.nodeType === 1 || this.nodeType === 11 ) {
					this.appendChild( elem );
				}
			});
		},

		appendStart: function() {
			return this.domManip(arguments, true, function( elem ) {
				if ( this.nodeType === 1 ) {
					this.insertBefore( elem, this.firstChild );
				}
			});
		},

		before: function() {
			if ( this.dom[0] && this.dom[0].parentNode ) {
				return this.domManip(arguments, false, function( elem ) {
					this.parentNode.insertBefore( elem, this );
				});
			} 
			else if ( arguments.length ) {
				var set = da(arguments[0]);
				set.dom.push.apply( set, this.toArray() );
				return this.pushStack( set, "before", arguments );
			}
		},
	
		after: function() {
			if ( this.dom[0] && this.dom[0].parentNode ) {
				return this.domManip(arguments, false, function( elem ) {
					this.parentNode.insertBefore( elem, this.nextSibling );
				});
			} else if ( arguments.length ) {
				var set = this.pushStack( this.dom, "after", arguments );
				set.dom.push.apply( set, da(arguments[0]).toArray() );
				return set;
			}
		},

		clone: function( dataAndEvents, deepDataAndEvents ) {
			dataAndEvents = dataAndEvents == null ? false : dataAndEvents;
			deepDataAndEvents = deepDataAndEvents == null ? dataAndEvents : deepDataAndEvents;

			return this.map( function() {
				return da.clone( this.dom[0], dataAndEvents, deepDataAndEvents );
			});
		},
	
		html: function( value ) {
			if ( value === undefined ) {
				return this.dom[0] && this.dom[0].nodeType === 1 ?
					this.dom[0].innerHTML.replace(daRe_inlineDA, "") :
					null;
	
			// See if we can take a shortcut and just use innerHTML
			} else if ( typeof value === "string" && !daRe_nocache.test( value ) &&
				(da.support.leadingWhitespace || !daRe_leadingWhitespace.test( value )) &&
				!daWrapMap[ (daRe_tagName.exec( value ) || ["", ""])[1].toLowerCase() ] ) {
	
				value = value.replace(daRe_xhtmlTag, "<$1></$2>");
	
				try {
					for ( var i = 0, l = this.dom.length; i < l; i++ ) {
						// Remove element nodes and prevent memory leaks
						if ( this.dom[i].nodeType === 1 ) {
							da.cleanData( this[i].getElementsByTagName("*") );
							this.dom[i].innerHTML = value;
						}
					}
	
				// If using innerHTML throws an exception, use the fallback method
				} 
				catch(e) {
					this.empty().append( value );
				}
	
			} else if ( da.isFunction( value ) ) {
				this.each(function(i){
					var self = da( this );
					self.html( value.call(this, i, self.html()) );
				});
	
			} else {
				this.empty().append( value );
			}
	
			return this;
		},
		
		replaceWith: function( value ) {
			if ( !isDisconnected( this[0] ) ) {
				// Make sure that the elements are removed from the DOM before they are inserted
				// this can help fix replacing a parent with child elements
				if ( jQuery.isFunction( value ) ) {
					return this.each(function(i) {
						var self = jQuery(this), old = self.html();
						self.replaceWith( value.call( this, i, old ) );
					});
				}

				if ( typeof value !== "string" ) {
					value = jQuery( value ).detach();
				}

				return this.each(function() {
					var next = this.nextSibling,
						parent = this.parentNode;

					jQuery( this ).remove();

					if ( next ) {
						jQuery(next).before( value );
					} else {
						jQuery(parent).append( value );
					}
				});
			}

			return this.length ?
				this.pushStack( jQuery(jQuery.isFunction(value) ? value() : value), "replaceWith", value ) :
				this;
		},
		
		/**�Ƴ�Ԫ�� ���Ƴ�ĳԪ���ڲ�ƥ����Ԫ��
		* params {String} selector ��Ԫ��ƥ��ѡ����
		* params {boolean} keepData �Ƿ���Ԫ�ص��Զ�����������
		*/
		remove: function( selector, keepData ) {
			for ( var i = 0, elem; (elem = this.dom[i]) != null; i++ ) {
				if ( !selector || da.filter( selector, [ elem ] ).length ) {
					if ( !keepData && elem.nodeType === 1 ) {
						da.cleanData( elem.getElementsByTagName("*") );
						da.cleanData( [ elem ] );
					}
					
				  if( da.browser.ie && elem.parentNode){
					  var ownerWin = elem.ownerDocument.parentWindow;           //��ȡ��ɾ������������������ҵ���Ӧ������Ͱ��
				  
					  if( !ownerWin.da.dustbin ){
						var obj = ownerWin.document.createElement('div');
						obj.id = "da_Dustbin";
						//document.body.insertBefore( d );
						ownerWin.da.dustbin = obj;
					  }

					  ownerWin.da.dustbin.insertBefore( elem );
					  ownerWin.da.dustbin.innerHTML = '';
					  
				  }
					else if ( elem.parentNode ) {
						elem.parentNode.removeChild( elem );
					}
				}
				
			}
			return this;
		},
		
		domManip: function( args, table, callback ) {
			var results, first, fragment, parent,
				value = args[0],
				scripts = [];
	
			// We can't cloneNode fragments that contain checked, in WebKit
			if ( !da.support.checkClone && 3 === arguments.length && "string" === typeof value && daRe_checked.test( value ) ) {
				return this.each(function() {
					da(this).domManip( args, table, callback, true );
				});
			}
	
			if ( da.isFunction(value) ) {
				return this.each(function(i) {
					var self = da(this);
					args[0] = value.call(this, i, table ? self.html() : undefined);
					self.domManip( args, table, callback );
				});
			}
	
			if ( this.dom[0] ) {
				parent = value && value.parentNode;
	
				// If we're in a fragment, just use that instead of building a new one
				if ( da.support.parentNode && parent && 11 === parent.nodeType && parent.childNodes.length === this.length ) {
					results = { fragment: parent };
	
				} else {
					results = da.buildFragment( args, this.dom, scripts );
				}
	
				fragment = results.fragment;
	
				if ( fragment.childNodes.length === 1 ) {
					first = fragment = fragment.firstChild;
				} else {
					first = fragment.firstChild;
				}
	
				if ( first ) {
					table = table && da.isNodeName( first, "tr" );
	
					for ( var i = 0, l = this.dom.length, lastIndex = l - 1; i < l; i++ ) {
						callback.call(
							table ? root(this.dom[i], first) : this.dom[i],
							// Make sure that we do not leak memory by inadvertently discarding
							// the original fragment (which might have attached data) instead of
							// using it; in addition, use the original fragment object for the last
							// item instead of first because it can end up being emptied incorrectly
							// in certain situations (Bug #8070).
							// Fragments from the fragment cache must always be cloned and never used
							// in place.
							results.cacheable || (l > 1 && i < lastIndex) ? da.clone( fragment, true, true ) : fragment
						);
					}
				}
	
				if ( scripts.length ) {
					da.each( scripts, function( i, elem ) {
						if ( elem.src ) {
							if ( da.ajax ) {
								da.ajax({
									url: elem.src,
									type: "GET",
									dataType: "script",
									async: false,
									global: false,
									"throws": true
								});
							} else {
								da.error("no ajax");
							}
						} else {
							da.globalEval( ( elem.text || elem.textContent || elem.innerHTML || "" ).replace( daRe_cleanScript, "" ) );
						}

						if ( elem.parentNode ) {
							elem.parentNode.removeChild( elem );
						}
					});
				}
			}
	
			return this;
		}
	});

	function root( elem, cur ) {
		return da.isNodeName(elem, "table") ?
			(elem.getElementsByTagName("tbody")[0] ||
			elem.appendChild(elem.ownerDocument.createElement("tbody"))) :
			elem;
	}
	
	function findOrAppend( elem, tag ) {
		return elem.getElementsByTagName( tag )[0] || elem.appendChild( elem.ownerDocument.createElement( tag ) );
	}

	function cloneCopyEvent( src, dest ) {

		if ( dest.nodeType !== 1 || !da.hasData( src ) ) {
			return;
		}

		var type, i, l,
			oldData = da._data( src ),
			curData = da._data( dest, oldData ),
			events = oldData.events;

		if ( events ) {
			delete curData.handle;
			curData.events = {};

			for ( type in events ) {
				for ( i = 0, l = events[ type ].length; i < l; i++ ) {
					da.event.add( dest, type, events[ type ][ i ] );
				}
			}
		}

		// make the cloned public data object a copy from the original
		if ( curData.data ) {
			curData.data = da.extend( {}, curData.data );
		}
	}

	function cloneFixAttributes( src, dest ) {
		var nodeName;

		// We do not need to do anything for non-Elements
		if ( dest.nodeType !== 1 ) {
			return;
		}

		// clearAttributes removes the attributes, which we don't want,
		// but also removes the attachEvent events, which we *do* want
		if ( dest.clearAttributes ) {
			dest.clearAttributes();
		}

		// mergeAttributes, in contrast, only merges back on the
		// original attributes, not the events
		if ( dest.mergeAttributes ) {
			dest.mergeAttributes( src );
		}

		nodeName = dest.nodeName.toLowerCase();

		// IE6-8 fail to clone children inside object elements that use
		// the proprietary classid attribute value (rather than the type
		// attribute) to identify the type of content to display
		if ( nodeName === "object" ) {
			dest.outerHTML = src.outerHTML;

		} else if ( nodeName === "input" && (src.type === "checkbox" || src.type === "radio") ) {
			// IE6-8 fails to persist the checked state of a cloned checkbox
			// or radio button. Worse, IE6-7 fail to give the cloned element
			// a checked appearance if the defaultChecked value isn't also set
			if ( src.checked ) {
				dest.defaultChecked = dest.checked = src.checked;
			}

			// IE6-7 get confused and end up setting the value of a cloned
			// checkbox/radio button to an empty string instead of "on"
			if ( dest.value !== src.value ) {
				dest.value = src.value;
			}

		// IE6-8 fails to return the selected option to the default selected
		// state when cloning options
		} else if ( nodeName === "option" ) {
			dest.selected = src.defaultSelected;

		// IE6-8 fails to set the defaultValue to the correct value when
		// cloning other types of input fields
		} else if ( nodeName === "input" || nodeName === "textarea" ) {
			dest.defaultValue = src.defaultValue;

		// IE blanks contents when cloning scripts
		} else if ( nodeName === "script" && dest.text !== src.text ) {
			dest.text = src.text;
		}

		// Event data gets referenced instead of copied if the expando
		// gets copied too
		dest.removeAttribute( da.expando );

		// Clear flags for bubbling special change/submit events, they must
		// be reattached when the newly cloned events are first activated
		dest.removeAttribute( "_submit_attached" );
		dest.removeAttribute( "_change_attached" );
	}
	
	//�ĵ�Ƭ�λ�����
	da.fragments = {};
	
	//�����������ĵ�����Ƭ�κ���
	/*
		args: �����б�
		nodes: Ԫ��Ƭ��
		scripts: �ű�Ƭ��
	*/
	da.buildFragment = function( args, nodes, scripts ) {
		var fragment, cacheable, cacheresults, doc,
			first = args[ 0 ];

		if ( nodes && nodes[0] ) {
			doc = nodes[0].ownerDocument || nodes[0];
		}

		if ( !doc.createDocumentFragment ) {
			doc = document;
		}

		if ( args.length === 1 && 
			typeof first === "string" && 
			first.length < 512 && 										//ֻ����0.5KB ��HTML����Ƭ��
			doc === document &&											//ֻ�����뵱ǰDocument��ص�HTML����Ƭ��
			first.charAt(0) === "<" && !daRe_nocache.test( first ) &&	//IE6 ������ȷ�Ŀ�¡�ĵ�Ƭ����optionԪ�ص�selectedѡ��״̬���ԣ�object��embedҲ������⣬���Բ������ˡ�
			(da.support.checkClone || !daRe_checked.test( first )) &&	//WebKit��������ĵ�Ƭ���У���¡Ԫ��ʱ��������ȷ�ĸ���checked״̬���ԣ����Բ������ˡ�
			(da.support.html5Clone || !daRe_noshimcache.test( first )) ) {

			cacheable = true;

			cacheresults = da.fragments[ first ];
			if ( cacheresults && cacheresults !== 1 ) {
				fragment = cacheresults;
			}
		}

		if ( !fragment ) {				//û�л�����ĵ�Ƭ�Σ��������ĵ�Ƭ��
			fragment = doc.createDocumentFragment();
			da.clean( args, doc, fragment, scripts );			//�����������ĵ�Ƭ����Ҫͨ��da.clean()������������һ��
		}

		if ( cacheable ) {				//���ĵ�Ƭ�λ���set����
			da.fragments[ first ] = cacheresults ? fragment : 1;
		}

		return { fragment: fragment, cacheable: cacheable };	//�����ĵ�Ƭ��
	};

	//��չ������ӡ���������⹦�ܵ�DOM�����������
	da.each({
		appendTo: "append",
		prependTo: "prepend",
		insertBefore: "before",
		insertAfter: "after",
		replaceAll: "replaceWith"
	}, function( name, original ) {
		da.fnStruct[ name ] = function( selector ) {
			var ret = [],
				insert = da( selector ),
				parent = this.dom.length === 1 && this.dom[0].parentNode;
	
			if ( parent && parent.nodeType === 11 && parent.childNodes.length === 1 && insert.dom.length === 1 ) {
				insert[ original ]( this.dom[0] );
				return this;
	
			} 
			else {
				for ( var i = 0, l = insert.dom.length; i < l; i++ ) {
					var elems = (i > 0 ? this.clone(true) : this).get();
					da( insert.dom[i] )[ original ]( elems );
					ret = ret.concat( elems );
				}
	
				return this.pushStack( ret, name, insert.selector );
			}
		};
	});


	function getAll( elem ) {
		if ( "getElementsByTagName" in elem ) {
			return elem.getElementsByTagName( "*" );
		
		} else if ( "querySelectorAll" in elem ) {
			return elem.querySelectorAll( "*" );
	
		} else {
			return [];
		}
	}
	
	//����checkbox��redio��defaultChecked���Ժ���
	/*
		elem: ��Ҫ������Ԫ�ض���
	*/
	function fixDefaultChecked( elem ) {
		if ( elem.type === "checkbox" || elem.type === "radio" ) {						//�ж��Ƿ���checkbox��redio�ؼ�
			elem.defaultChecked = elem.checked;
		}
	}
	
	//�ҵ�����inputԪ��Ȼ�󴫸�fixDefaultChecked()��������
	/*
		elem: ���ҷ�ΧԪ�ض���
	*/
	function findInputs( elem ) {
		if ( da.isNodeName( elem, "input" ) ) {																//������ҷ�ΧԪ�ر�����input,��ֱ�ӵ���fixDefaultChecked()��������
			fixDefaultChecked( elem );
		} 
		else if ( elem.getElementsByTagName ) {																//��������ж��inputԪ�أ��ͽ�fixDefaultChecked()������Ϊ��֤�ص���������ͨ��da.grep()������������
			da.grep( elem.getElementsByTagName("input"), fixDefaultChecked );
		}
		
	}
	
	//Ԫ�ؿ�¡������������
	da.extend({
		//��¡Ԫ�غ���
		/*
			elem: Ԫ�ض���
			dataAndEvents: Ԫ�ض�Ӧ���ݺ��¼�
			deepDataAndEvents: ���Ԫ�����ݺ��¼�
		*/
		clone: function( elem, dataAndEvents, deepDataAndEvents ) {
			var clone = elem.cloneNode(true),
					srcElements,
					destElements,
					i;
	
			if ( (!da.support.noCloneEvent || !da.support.noCloneChecked) &&
					(elem.nodeType === 1 || elem.nodeType === 11) && !da.isXMLDoc(elem) ) {
				// IE copies events bound via attachEvent when using cloneNode.
				// Calling detachEvent on the clone will also remove the events
				// from the original. In order to get around this, we use some
				// proprietary methods to clear the events. Thanks to MooTools
				// guys for this hotness.
	
				cloneFixAttributes( elem, clone );
	
				// Using Sizzle here is crazy slow, so we use getElementsByTagName
				// instead
				srcElements = getAll( elem );
				destElements = getAll( clone );
	
				// Weird iteration because IE will replace the length property
				// with an element if you are cloning the body and one of the
				// elements on the page has a name or id of "length"
				for ( i = 0; srcElements[i]; ++i ) {
					cloneFixAttributes( srcElements[i], destElements[i] );
				}
			}
	
			// Copy the events from the original to the clone
			if ( dataAndEvents ) {
				cloneCopyEvent( elem, clone );
	
				if ( deepDataAndEvents ) {
					srcElements = getAll( elem );
					destElements = getAll( clone );
	
					for ( i = 0; srcElements[i]; ++i ) {
						cloneCopyEvent( srcElements[i], destElements[i] );
					}
				}
			}
	
			// Return the cloned set
			return clone;
		},
		
		//���������ĵ�Ƭ�κ���
		/*
			elems�� Ԫ�ض��󼯺�
			context: ������
			fragment: �ĵ�Ƭ��
			scripts: �ű�Ƭ��
		*/
		clean: function( elems, context, fragment, scripts ) {
			var checkScriptType;
	
			context = context || doc;
	
			// !context.createElement fails in IE with an error but returns typeof 'object'
			if ( "undefined" === typeof context.createElement ) {
				context = context.ownerDocument || context[0] && context[0].ownerDocument || doc;
			}
	
			var ret = [];
	
			for ( var i = 0, elem; null != (elem = elems[i]); i++ ) {
				if ( typeof elem === "number" ) {
					elem += "";
				}
	
				if ( !elem ) {
					continue;
				}
	
				if ( "string" === typeof elem ) {											//��HTML����Ƭ��д��Ԫ�ؽڵ�����У�����ת��
					if ( !daRe_html.test( elem ) ) {										//ƥ���ж��Ƿ���Ԫ�ر�ǩ���ţ����û�оʹ���Ϊ�ı���ǩ
						elem = context.createTextNode( elem );
					} 
					else {																							//��Ҫ����Ԫ�ؽڵ�
						elem = elem.replace( daRe_xhtmlTag, "<$1></$2>" );											//���������������"XHTML"��style��ǩ
	
						// Trim whitespace, otherwise indexOf won't work as expected
						var tag = ( daRe_tagName.exec( elem ) || ["", ""] )[1].toLowerCase(),
								wrap = daWrapMap[ tag ] || daWrapMap._default,											//����ĵ�Ƭ��Ԫ�ض�����Ҫ����
								depth = wrap[0],
								div = context.createElement("div");
	
						div.innerHTML = wrap[1] + elem + wrap[2];					// Go to html and back, then peel off extra wrappers
	
						while ( depth-- ) {																//ͨ�������������ҵ�������Ԫ�ض���
							div = div.lastChild;
						}
	
						if ( da.support.tbody ) {													//�����IE���������Ҫɾ���Զ������tBody��ǩԪ��
							var hasBody = daRe_tbody.test(elem),
									tbody = ( "table" === tag && !hasBody ) ? 
									( div.firstChild && div.firstChild.childNodes ) : ( "<table>" === wrap[1] && !hasBody ) ?											// String was a bare <thead> or <tfoot>
									div.childNodes : [];
	
							for ( var j = tbody.length -1; j >= 0; --j ) {
								if ( da.isNodeName( tbody[ j ], "tbody" ) && !tbody[ j ].childNodes.length ) {
									tbody[ j ].parentNode.removeChild( tbody[ j ] );
								}
							}
							
						}
	
						if ( !da.support.leadingWhitespace 								//IE��ִ��innerHTMLʱ��ȥ��HTML����ǰ�������пո�
						&& daRe_leadingWhitespace.test( elem ) ) {													
							div.insertBefore( context.createTextNode( daRe_leadingWhitespace.exec( elem )[0] ), div.firstChild );
						}
	
						elem = div.childNodes;
					}
					
				}
				
				//�����IE6/7���������ĵ�����Ƭ����redio��checkbox֮ǰ����Ҫ����һ��defaultChecked����
				var len;
				if ( !da.support.appendChecked ) {
					if ( elem[0] && "number" === typeof (len = elem.length) ) {
						for ( i = 0; i < len; i++ ) {
							findInputs( elem[i] );
						}
					}
					else {
						findInputs( elem );
					}
				}
				
				if ( elem.nodeType ) {								//����Ԫ��
					ret.push( elem );
				}
				else {																//���Ԫ�ص����飬����ͨ��da.merge()�����ϲ���ret������
					ret = da.merge( ret, elem );			
				}
				
			}
	
			if ( fragment ) {
				checkScriptType = function( elem ) {														//��ʱ��������֤Ԫ�� �Ƿ��ǽű�Ԫ������ ������
					return !elem.type || daRe_scriptType.test( elem.type );
				};
				
				for ( var i=0; ret[i]; i++ ) {
					if ( scripts 																																							//����û��д���ű�������
					&& da.isNodeName( ret[i], "script" ) 																											//���� �ĵ�Ƭ�����нŲ�Ԫ��
					&& (!ret[i].type || ret[i].type.toLowerCase() === "text/javascript") ) {									//���� �ű�Ԫ�ر���Ϊjs����
						scripts.push( ret[i].parentNode ? ret[i].parentNode.removeChild( ret[i] ) : ret[i] );		//���ű�Ƭ��ѹ��ű�������
	
					}
					else {																																										//���û�нű������� ��ͨ�����־�ķ�ʽ���ְ�
						if ( ret[i].nodeType === 1 ) {
							var jsTags = da.grep( ret[i].getElementsByTagName( "script" ), checkScriptType );
	
							ret.splice.apply( ret, [i + 1, 0].concat( jsTags ) );
							
						}
						fragment.appendChild( ret[i] );
					}
					
				}
				
			}
	
			return ret;
		},
	
		//����Ԫ�����ݺ���
		/*
			elems: Ԫ�ض��󼯺�
		*/
		cleanData: function( elems ) {
			var data, id, cache = da.cache,
					internalKey = da.expando, 
					special = da.event.special,
					deleteExpando = da.support.deleteExpando;
	
			for ( var i = 0, elem; (elem = elems[i]) != null; i++ ) {
				if ( elem.nodeName && da.noData[elem.nodeName.toLowerCase()] ) continue;
	
				id = elem[ da.expando ];
	
				if ( id ) {
//					data = cache[ id ] && cache[ id ][ internalKey ];					//internalKey �����ڲ�ʹ�ñ�ǣ���ʱ������ñ��ϻ��ưɣ��漰��ش���̫�ࣩ��
					data = cache[ id ];
					
					if ( data && data.events ) {
						for ( var type in data.events ) {
							if ( special[ type ] ) {
								da.event.remove( elem, type );
	
							// This is a shortcut to avoid jQuery.event.remove's overhead
							} else {
								da.removeEvent( elem, type, data.handle );
							}
						}
	
						// Null the DOM reference to avoid IE6/7/8 leak (#7054)
						if ( data.handle ) {
							data.handle.elem = null;
						}
					}
	
					if ( deleteExpando ) {
						delete elem[ da.expando ];
	
					} else if ( elem.removeAttribute ) {
						elem.removeAttribute( da.expando );
					}
	
					delete cache[ id ];
				}
			}
			
		}
		
		
	});
	
	
})(da);

/***************** CSS *****************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: Ԫ����ʽ������
	version: 1.0.0
*/
(function(da){

	//CSS����Դ��������ʽ
	var	daRe_exclude = /z-?index|font-?weight|opacity|zoom|line-?height/i,
		daRe_alpha = /alpha\([^)]*\)/,
		daRe_opacity = /opacity=([^)]*)/,
		daRe_float = /float/i,
		daRe_upper = /([A-Z])/g,
		daRe_numpx = /^-?\d+(?:px)?$/i,
		daRe_num = /^-?\d/;
	
	//DOM���� ��ʽ���� ����������չ
	da.fnStruct.extend({
		//�ڵ���ʽ���� ��������
		/*
			name: style��ʽ������
			value: style��ʽ����ֵ
		*/
		css: function(name, value ) {
			var ret = da.access( this, function( elem, name, value ) {
				return value !== undefined ?
					da.style( elem, name, value ) :			//set����
					da.css( elem, name );					//get����
					
			}, name, value, arguments.length > 1 );
			
			return ret;
		}
	});
	
	da.extend({
		/**��pxΪ��λ�����Զ��ձ�
		*/
		cssNumber: {
			"zIndex": true,
			"fontWeight": true,
			"opacity": true,
			"zoom": true,
			"lineHeight": true,
			"widows": true,
			"orphans": true
		},
		
		//�ڵ�������ȼ���ʽ���� ��������
		/*
			obj: DOM�ڵ����
			name: style��ʽ������
		*/
		curCSS: function( obj, name ) {
			var ret, style = obj.style, filter;
			
			//IE��֧��opacity���ԣ���Ҫ��filter�˾�����
			if ( !da.support.opacity && "opacity"===name && obj.currentStyle ) {									//currentStyle��������ȫ����ʽ����Ƕ��ʽ��HTML��ǩ������ָ���Ķ����ʽ����ʽ(��width��height)��
				ret = daRe_opacity.test(obj.currentStyle.filter || "") ? ((parseFloat(RegExp.$1)/100) +"") : "";		//����ҵ�opacity���ԣ����ص�һ��ƥ�������ֵ
				
				return (""===ret) ? "1" : ret;		//���û�ж���opacity����Ĭ�Ϸ���1 (100%��ʾ)
			}
	
			//������ ��ʽ��׼������
			if ( daRe_float.test( name ) ) name=da.support.cssFloat ? "cssFloat" : "styleFloat";			//��Ϊfloat��js�Ĺؼ���,����js�涨��λfloatҪ��cssFloat����Ϊ�˼���IEҪ��styleFloat����
			
			//����ڵ�style��������Ӧ����Ƕֵ��ֱ��ȡ��Ƕֵ
			//style�е��������ȼ�����class,���Կ����ȴ�style���ң�Ȼ���ٴ��Ѿ�����õ�css�������ҡ�
			//�����Ƕstyle����ʹ����!import����������⣬�Ͳ���ֱ��ȡstyle����ֵ��
			if ( style && style[ name ] ) {
				ret = style[ name ];
	
			}
			//FireFox �ȱ�׼�������ͨ��getComputedStyle��ȡ��ǰ����õ���ʽ����ֵ
			else if ( da.support.getComputedStyle ) {
				if ( daRe_float.test( name ) ) {															//��ʹ��getPropertyValue��ȡfloat����ֵʱ����Ҫ��ǰ���ʽ���õ�cssFloat��styleFloat���������Ļ�Ϊfloat
					name = "float";
				}
				
				name = name.replace( daRe_upper, "-$1" ).toLowerCase();				//��:font-Weight���м䲿�ִ�д���շ��ʽ "-W"�滻�� "-w"Сд
	
				var defaultView = obj.ownerDocument.defaultView;
	
				if ( !defaultView ) {
					return null;
				}
	
				var computedStyle = defaultView.getComputedStyle( obj, null );
	
				if ( computedStyle ) {
					ret = computedStyle.getPropertyValue( name );
				}
	
				if ( "opacity"===name && ""===ret ) {										//���û�ж���opacity����Ĭ�Ϸ���1 (100%��ʾ)
					ret = "1";			
				}
		
			}
			//IE ͨ��currentStyle��ȡ��ǰ����õ���ʽ����ֵ
			else if ( obj.currentStyle ) {
				var camelCase = da.camelCase(name);						//��:font-weight���м䲿�� "-w"�滻�� "-W"��д���շ��ʽ
	
				ret = obj.currentStyle[ name ] || obj.currentStyle[ camelCase ];
	
				//�������ص�λ������ֵ ת��Ϊ������Ϊ��λ��ֵ
				if ( !(daRe_numpx.test( ret )) && (daRe_num.test( ret )) ) {			//��ֵ���Ҳ���px��λ������ֵ
						var left = style.left, rsLeft = obj.runtimeStyle.left;				//����һ�µ�ǰ������ֵ
						
						obj.runtimeStyle.left = obj.currentStyle.left;								//�����ȼ���ߵ���ʽ ��ֵ��runtimeStyle����ǰ���ֵ���ʽ���ԣ�
						style.left = ("fontSize"===camelCase) ? "1em" : (ret || 0);		//��ѹ��������ֵ�󣬻�ȡȫ�¼������ ������Ϊ��λ����ʽֵ
						ret = style.pixelLeft + "px";
		
						style.left = left;																						//��ԭ����ʱ�ı������ֵ
						obj.runtimeStyle.left = rsLeft;
				}
			}
	
			return ret;
		},
		
		//ͨ��������ʽֵ��, �ص�callback����, Ȼ��ԭ��ʽ
		/*
			obj: DOM�ڵ����
			options: ��ʽֵ��ֵ�Զ���
			callback:	�ص�����
		*/
		swap: function( obj, options, callback ) {
			var old = {};
	
			for ( var name in options ) {						//����һ�µ�ǰ������ֵ
				old[ name ] = obj.style[ name ];
				obj.style[ name ] = options[ name ];
			}
			
			callback.call( obj );
			
			for ( var name in options ) {						//��ԭ����ʱ�ı������ֵ
				obj.style[ name ] = old[ name ];
			}
		},
		
		//�ڵ���ʽ���� ��������
		/*
			obj: DOM�ڵ����
			name: style��ʽ������
			extra: ����,��:margin, padding, border
		*/
		css: function( obj, name, extra ) {
			//�Խڵ�Ԫ�صĸ߿����������������㷨��ͳһ
			//IE�нڵ�Ԫ�ص�ʵ�ʸ߿��ǰ���content, padding, border���ܺ�,��firefox��ֻ��content�ĳߴ�;
			//����Ĭ����content�ĳߴ�Ϊ�ڵ�Ԫ�ص�ʵ�ʸ߿�
			if ( name === "width" || name === "height" ) {
				var val,
				props = { position: "absolute", visibility: "hidden", display:"block" }, 
				which = ("width"===name ? [ "Left", "Right" ] : [ "Top", "Bottom" ]);
				
				//��ڵ�Ԫ�ص�ʵ�ʸ߶ȺͿ�ȣ���padding��border��
				function getWH() {
					val = name === "width" ? obj.offsetWidth : obj.offsetHeight;
	
					if ( extra === "border" ) {
						return;
					}
					
					for(var s=0,len=which.length; s<len; s++){
						if ( !extra ) {
							val -= parseFloat(da.curCSS( obj, "padding"+ which[s])) || 0;
						}
	
						if ( extra === "margin" ) {
							val += parseFloat(da.curCSS( obj, "margin"+ which[s])) || 0;
						}
						else {
							val -= parseFloat(da.curCSS( obj, "border"+ which[s] + "Width")) || 0;
						}
					}
				}
				
				//����ڵ�Ԫ�ص�ǰΪ�ɼ�����ֱ��ͨ��getWH ����������ʵ�ʸ߶ȺͿ��
				if ( obj.offsetWidth !== 0 ) {
					getWH();
				}
				//����ڵ�Ԫ�ص�ǰ ���ɼ������ýڵ�Ԫ�ض���Ϊ���Զ�λ( position: "absolute" )���ɼ�( visibility: "hidden"��display:"block" )Ȼ����ȡʵ�ʸ߶ȺͿ��( ��Ϊ���ɼ��Ľڵ�Ԫ��������ǲ�������߿�� )
				else {
					da.swap( obj, props, getWH );
				}
	
				return Math.max(0, Math.round(val));
			}
	
			return da.curCSS( obj, name );
		},
	
		//�ڵ�style��ʽ���Բ�������
		/*
			obj: DOM�ڵ����
			name: style��ʽ������
			value: style��ʽ����ֵ
		*/
		style: function( obj, name, value ) {
			if ( !obj || !obj.style || obj.nodeType === 3 || obj.nodeType === 8 ) {			//�������÷�����Եļ��ı� ��һЩ�������͵Ľڵ�Ԫ�أ�nodeType�� 1=Ԫ��element�� 2=����attr�� 3=�ı�text�� 8=ע��comments�� 9=�ĵ�document��
				return undefined;
			}
	
			if ( ( "width"===name || "height"===name ) && parseFloat(value) < 0 ) {		//width ��height���Բ���Ϊ����
				value = undefined;
			}
	
			var style = obj.style || obj, set = value !== undefined;				//����Ǹ�ֵ�����������ֵ
	
			//IE��֧��opacity���ԣ���Ҫ��filter�˾�����
			if ( !da.support.opacity && "opacity"===name ) {
				if ( set ) {
					style.zoom = 1;			//IE��bug,����layoutģʽ��Ԫ��ʹ��opacity���Ի�ʧЧ,����zoomֵ���Խ��
	
					var opacity = "NaN"===(parseInt( value, 10 )+ "") ? "" : ("alpha(opacity="+ value*100+ ")");	//ͨ��alpha����������Ч��opacity����
					var filter = style.filter || da.curCSS( obj, "filter" ) || "";																//���ҽڵ��style���� ����ʽ���е��˾�����
					
					style.filter = daRe_alpha.test(filter) ? filter.replace(daRe_alpha, opacity) : opacity;			//У���ڵ��˾�����
				}
	
				return (style.filter && 0<=style.filter.indexOf("opacity=")) ? ((parseFloat( daRe_opacity.exec(style.filter)[1] ) / 100) +"") : "";			//���ز�͸��������ֵ
			}
			
			//������ ��ʽ��׼������
			if ( daRe_float.test( name ) ) name=da.support.cssFloat ? "cssFloat" : "styleFloat";			//��Ϊfloat��js�Ĺؼ���,����js�涨��λfloatҪ��cssFloat����Ϊ�˼���IEҪ��styleFloat����
			name = da.camelCase(name);																		//��:font-weight���м䲿�� "-w"�滻�� "-W"��д���շ��ʽ
	
			if ( set )	style[ name ] = value;			//����Ǹ�ֵ�������͸���Ӧ��ʽ���Ը�ֵ

			return style[ name ];
		}
			
	});
	
})(da);

/***************** Ajax ***********************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: Ajax�첽���������� ���Ĵ���
	version: 1.0.0
*/
(function(da){
	var jsc = da.nowId(),
			daRe_noContent = /^(?:GET|HEAD)$/,
			daRe_hash = /#.*$/,
			daRe_jsre = /\=\?(&|$)/,
			daRe_ts = /([?&])_=[^&]*/,
			daRe_query = /\?/,
			daRe_url = /^(\w+:)?\/\/([^\/?#]+)/,
			daRe_20 = /%20/g,
			daRe_bracket = /\[\]$/;

	// Attach a bunch of functions for handling common AJAX events
	//��չ��ajaxȫ�ֺ���
	da.each( "ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "), 
	function( i, v ) {
		da.fnStruct[v] = function( f ) {
			return this.bind( v, f );
		};
	});
	
	da.extend({
		get: function( url, data, callback, type ) {
			// shift arguments if data argument was omited
			if ( da.isFunction( data ) ) {
				type = type || callback;
				callback = data;
				data = null;
			}
	
			return da.ajax({
				type: "GET",
				url: url,
				data: data,
				success: callback,
				dataType: type
			});
		},
	
		getScript: function( url, callback ) {
			return da.get(url, null, callback, "script");
		},
	
		getJSON: function( url, data, callback ) {
			return da.get(url, data, callback, "json");
		},
	
		post: function( url, data, callback, type ) {
			// shift arguments if data argument was omited
			if ( da.isFunction( data ) ) {
				type = type || callback;
				callback = data;
				data = {};
			}
	
			return da.ajax({
				type: "POST",
				url: url,
				data: data,
				success: callback,
				dataType: type
			});
		},
		
		//��request����ı�Ԫ��������ֵ�Բ����������л�Ϊһ����ѯ�ַ���
		/*
			a: ��Ԫ��������ֵ�Բ�����
			traditional: �Ƿ��ô�ͳ�ķ�ʽ�����л�����
		*/
		param: function( a, traditional ) {
			var s = [],
					add = function( key, value ) {
						value = da.isFunction(value) ? value() : value;																//�������ֵ�Ǻ������ͣ��͵��ú������ٻ�÷���ֵ
						s[ s.length ] = encodeURIComponent(key) + "=" + encodeURIComponent(value);		//���������Ͳ���ֵ�������ѹ����ʱ����
					};
			
			if ( traditional === undefined ) {						//�ϰ汾traditionalΪtrue
				traditional = da.ajaxSettings.traditional;
			}
			
			//if ( da.isArray(a) || a.jquery ) {
			if ( da.isArray(a) ) {												//��������a���������ͣ����ȼٶ����Ǳ�DOM����Ԫ�ؼ�,��Ԫ�ص�name��value,�ֱ�ӳ�䵽key��value
				da.each( a, function() {										//���л���Ԫ������
					add( this.name, this.value );
				});
				
			} 
			else {																				//��������a�Ǽ�ֵ�Բ�����
				// If traditional, encode the "old" way (the way 1.3.2 or older
				// did it), otherwise encode params recursively.
				for ( var prefix in a ) {
					buildParams( prefix, a[prefix], traditional, add );				//��Լ�ֵ�ԣ������Ƕ༶��ר��дһ��buildParams()���������л�
				}
			}
			
			return s.join("&").replace(daRe_20, "+");					//��&���ŷָ�,������ʱ���飬���ѿո�(" ")����encodeURIComponent()�����������ַ�"%20"�滻Ϊ"+"��
		},
		
		ajaxSetup: function( settings ) {								//ajaxȫ������
			da.extend( da.ajaxSettings, settings );
		},
	
		ajaxSettings: {	
			url: location.href,																		//�����ַ
			global: true,
			type: "GET",																					//����ģʽ
			contentType: "application/x-www-form-urlencoded",			//������Ϣ��������ʱ���ݱ������͡�Ĭ��ֵ�ʺϴ���������
			processData: true,																		//�Ƿ�����������ֵ
			async: true,																					//�Ƿ��첽
			/*
			timeout: 0,
			data: null,
			username: null,
			password: null,
			traditional: false,
			*/
			// This function can be overriden by calling jQuery.ajaxSetup
			xhr: function() {
				return new window.XMLHttpRequest();
			},
			accepts: {
				xml: "application/xml, text/xml",
				html: "text/html",
				script: "application/javascript, text/javascript",
				json: "application/json, text/javascript",
				text: "text/plain",
				_default: "*/*"
			}
		},
	
		//�첽���ݷ���
		/*
			origSettings: ������
			{������: ��ѡֵ = 
				[type: "GET"/"POST"/"PUT"/"DELETE" = "GET"],
				[url: "" = location.href],
			}
		*/
		ajax: function( origSettings ) {
			var s = da.extend( true, {}, da.ajaxSettings, origSettings ),					//��ajaxSettings��origSettings����ϲ������s�ֲ�����
				jsonp, 																							//jsonp��ʱ����
				status, 																						//request�������״̬
				data, 																							//�������ش����ݻ���
				type = s.type.toUpperCase(), 												//����ʽ���� "POST" �� "GET"( Ĭ��Ϊ "GET" )
				noContent = daRe_noContent.test( type );
	
			s.url = s.url.replace( daRe_hash, "" );								//ȥ��urlê�������#������
			s.context = ( origSettings && origSettings.context != null ) ? 
									origSettings.context : s;																	//ajax��ػص�����(success,error,complate)��������,����û��ṩ��������,�����ṩ�ġ�( Ĭ��this��ָ����ñ���ajax����ʱ���ݵ�options���� )
	
			if ( s.data && s.processData && ( "string" !== typeof s.data ) ) {		//����д�������data������ֵ��������Ҫ����������processData( Ĭ��Ϊtrue )������data�������ַ�������ʽ���룬������תΪ��ѯ�ַ���
				s.data = da.param( s.data, s.traditional );
			}
	
			//************ ��jsonp��ʽע��ص��������� begin ******************/
			if ( s.dataType === "jsonp" ) {												//����jsonp������
				if ( type === "GET" ) {															//�����getģʽ
					if ( !daRe_jsre.test( s.url ) ) {									//��֤getģʽ�µ�url��ַ���� callback=? ��֮��Ĵ������ϻص�������
						s.url += (rquery.test( s.url ) ? "&" : "?") 
											+ (s.jsonp || "callback") 
											+ "=?";
					}
				}
				else if ( !s.data || !daRe_jsre.test(s.data) ) {		//�������getģʽ,������data������Ҳû�� callback=? �ͼ���ò���ģ��
					s.data = (s.data ? s.data+"&" : "") 
										+ (s.jsonp || "callback") 
										+ "=?";
				}
				s.dataType = "json";																//��Ϊjsonp��json��ʽ����չ
			}
	
			if ( s.dataType === "json" && (s.data && daRe_jsre.test(s.data) || daRe_jsre.test(s.url)) ) {			//������ݸ�ʽ��json���ҷ���ӵ�� callback=? ����ģ�͵�����,�Ͷ��乹��json��ʱ����
				jsonp = s.jsonpCallback || ("jsonp" + jsc++);				//���û�д������ ����Ĭ��jsonp+ΨһID �ĸ�ʽ
	
				if ( s.data ) {
					s.data = (s.data + "").replace( daRe_jsre, "=" + jsonp + "$1" );	//�滻�������data������ callback=?�Ĳ���ģ��,$1Ϊ����ʶ���׺
				}
		
				s.url = s.url.replace( daRe_jsre, "=" + jsonp + "$1" );							//�滻url������ callback=?�Ĳ���ģ��,$1Ϊ����ʶ���׺
	
				s.dataType = "script";															//��֤���jsonp�ĸ�ʽ��script,�������ܱ�֤���������ش��뱻��ȷִ��
	
				var customJsonp = window[ jsonp ];									//����jsonp��������
				
				window[ jsonp ] = function( tmp ) {									//�ڵ�ǰҳ��ע��һ��jsonp�ص�����,��֮���ajax����������󷵻�ִ����
						if ( da.isFunction( customJsonp ) ) {						//����ͻ���ͬ����Ա Ҳ��һ������������ִ�пͻ���ͬ������
							customJsonp( tmp );
		
						}
						else {																					//��Դ���յ�ǰjsonp�ص�����
							window[ jsonp ] = undefined;
							try {
								delete window[ jsonp ];
							} catch( jsonpError ) {};
							
						}
		
						data = tmp;																			//�������ش��������ݻ���
						da.handleSuccess( s, xhr, status, data );				//����Success�ص�����
						da.handleComplete( s, xhr, status, data );			//����Complete�ص�����
						
						if ( head ) {
							head.removeChild( script );										//ȥ��head�м����scriptԪ��
						}
						
				};
			}
			//************ ��jsonp��ʽע��ص��������� end ******************/
	
	
			//************ ��scriptTag��ʽִ�лص����� begin ******************/
			if ( s.dataType === "script" && s.cache === null ) {
				s.cache = false;
			}
	
			if ( s.cache === false && noContent ) {								//cache: false����ʱ���
				var ts = da.nowId();
	
				var ret = s.url.replace( daRe_ts, "$1_=" + ts );		//����_=���滻��$1_=ʱ�����
				s.url = ret + ((ret === s.url) ? ( (daRe_query.test(s.url) ? "&" : "?") + "_=" + ts ) : "");		//���ûӴ�滻�����������ں���׷��ʱ���
				
			}
	
			if ( s.data && noContent ) {													//����GET|HEAD�������󣬲���data������Ч����data���������ӵ�url�����б���
				s.url += ( daRe_query.test(s.url) ? "&" : "?" ) + s.data;
			}
	
			if ( s.global && da.active++ === 0 ) {								//��Ҫ����ajaxȫ�ֺ���ajaxStart(Ĭ��Ϊtrue)���������da.active Ϊ 0������һ���µ��������
					da.event.trigger( "ajaxStart" );
			}
	
			var parts = daRe_url.exec( s.url ),										//��������url��ַ,���ұ���domain
					remote = parts && (parts[1] && parts[1].toLowerCase() !== location.protocol || parts[2].toLowerCase() !== location.host);		//location�ǵ�ǰwindow�����ԣ���url��ַ�Ƚϣ��ж��Ƿ�Զ�̿���
	
			if ( s.dataType === "script" && type === "GET" && remote ) {						//����������һ����Զ�̿�����ĵ������ҳ��Լ���getģʽ�µ�json��script
				var head = document.getElementsByTagName("head")[0] || document.documentElement;
				var script = document.createElement("script");
				if ( s.scriptCharset ) {														//scriptCharset�ű�����
					script.charset = s.scriptCharset;
				}
				script.src = s.url;																	//js�ļ���ַԴ
	
				if ( !jsonp ) {																			//�������jsonp����script,ͨ��scriptԪ�ص�onload��onreadystatechange�¼��������ص�����
					var done = false;
	
					script.onload = script.onreadystatechange = function() {
							if ( !done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete") ) {
									done = true;
									da.handleSuccess( s, xhr, status, data );							//����Success�ص�����
									da.handleComplete( s, xhr, status, data );						//����Complete�ص�����
			
									script.onload = script.onreadystatechange = null;			//��Դ���յ�ǰjsonp�ص�����
									if ( head && script.parentNode ) {
											head.removeChild( script );
									}
							}
					};
					
				}
	
				head.insertBefore( script, head.firstChild );								//��insertBefore��������appendChild��Ҫ����� IE6��bug.
	
				return undefined;				//�Ѿ�ʹ����scriptԪ��ע��������
			}
			//************ ��scriptTag��ʽִ�лص����� end ******************/
	
			var requestDone = false;	//request����״̬
			var xhr = s.xhr();				//����һ��XMLHttpRequest����
			if ( !xhr ) return;
	
			if ( s.username ) {																						//����һ���������ӣ���Opera�������usernameΪnull���ᵯ����¼���棬����Ҫ����username��password
				xhr.open(type, s.url, s.async, s.username, s.password);
			}
			else {
				xhr.open(type, s.url, s.async);
				
			}
	
			try {											//��ֹfirefox�ڿ��������ʱ�򱨴���������try��catch
				if ( ( s.data != null && !noContent ) 
						|| ( origSettings && origSettings.contentType ) ) {			//���content-type���ض��Ĳ�����������content-type
					xhr.setRequestHeader("Content-Type", s.contentType);			//contentType(Ĭ��: "application/x-www-form-urlencoded") ������Ϣ��������ʱ���ݱ������͡�Ĭ��ֵ�ʺϴ���������
				}
	
				if ( s.ifModified ) {																				//ifModified(Ĭ��: false) ���ڷ��������ݸı�ʱ��ȡ�����ݡ�ʹ�� HTTP �� Last-Modified ͷ��Ϣ�жϡ���Ҳ���������ָ����'etag'��ȷ������û�б��޸Ĺ���
					if ( da.lastModified[s.url] ) {
						xhr.setRequestHeader("If-Modified-Since", da.lastModified[s.url]);
					}
	
					if ( da.etag[s.url] ) {
						xhr.setRequestHeader("If-None-Match", da.etag[s.url]);
					}
				}
	
				if ( !remote ) {																						
					xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");						//����requestͷ���÷�����֪������һ��XMLHttpRequest���ⲻ��һ��������ʵ�xhr����ô��ֻ�ᷢ�����ͷ��Ϣ
				}
	
				xhr.setRequestHeader("Accept", ( s.dataType && s.accepts[ s.dataType ] ) ? 
																					( s.accepts[ s.dataType ] + ", */*; q=0.01" ) : s.accepts._default );			//����dataType����ֵ������acceptsͷ�����ݸ�����������ܽ��յ�content-type����(Ĭ��Ϊ��������*/*)
				
			} catch( headerError ) {}
	
			if ( s.beforeSend && s.beforeSend.call(s.context, xhr, s) === false ) {		//beforeSend()���غ�����������ڷ���reqest����֮ǰ�����жϣ����beforeSend()��������ֵΪfalse����ô���reqest���󽫱��ж�
				if ( s.global && da.active-- === 1 ) {					//��reqest������ֹ���������� -1
					da.event.trigger( "ajaxStop" );
				}
	
				xhr.abort();																		//��ֹrequest����
				return false;
			}
			
			if ( s.global ) {																	//����ajaxȫ�ֺ���ajaxSend
				da.triggerGlobal( s, "ajaxSend", [xhr, s] );
			}

			//readyState״̬˵��
			//
			//(0)δ��ʼ��
			//			�˽׶�ȷ��XMLHttpRequest�����Ƿ񴴽�����Ϊ����open()��������δ��ʼ������׼����ֵΪ0��ʾ�����Ѿ����ڣ�����������ᱨ�������󲻴��ڡ�
			//(1)����
			//			�˽׶ζ�XMLHttpRequest������г�ʼ����������open()���������ݲ���(method,url,true)��ɶ���״̬�����á�������send()������ʼ�����˷�������ֵΪ1��ʾ���������˷�������
			//(2)�������
			//			�˽׶ν��շ������˵���Ӧ���ݡ�����õĻ�ֻ�Ƿ������Ӧ��ԭʼ���ݣ�������ֱ���ڿͻ���ʹ�á�ֵΪ2��ʾ�Ѿ�������ȫ����Ӧ���ݡ���Ϊ��һ�׶ζ����ݽ�������׼����
			//(3)����
			//			�˽׶ν������յ��ķ���������Ӧ���ݡ������ݷ���������Ӧͷ�����ص�MIME���Ͱ�����ת������ͨ��responseBody��responseText��responseXML���Դ�ȡ�ĸ�ʽ��Ϊ�ڿͻ��˵�������׼����״̬3��ʾ���ڽ������ݡ�
			//(4)���
			//			�˽׶�ȷ��ȫ�����ݶ��Ѿ�����Ϊ�ͻ��˿��õĸ�ʽ�������Ѿ���ɡ�ֵΪ4��ʾ���ݽ�����ϣ�����ͨ��XMLHttpRequest�������Ӧ����ȡ�����ݡ�
			//�Ŷ���֮������XMLHttpRequest�������������Ӧ�ð������½׶Σ�
			//��������ʼ�����󣭷������󣭽������ݣ��������ݣ����
			var onreadystatechange = xhr.onreadystatechange = function( isTimeout ) {					//����response���أ�����һ��onreadystatechange����������ҪΪ����ص���
						if ( !xhr || xhr.readyState === 0 || isTimeout === "abort" ) {							//������ֹ
								if ( !requestDone ) {																										//Opera�����xhr��ֹ�˲������onreadystatechange,����ģ�����һ��
									da.handleComplete( s, xhr, status, data );
								}
				
								requestDone = true;
								if ( xhr ) {
									xhr.onreadystatechange = da.noop;			//�ı�״̬, �ÿ���Ϣ����
								}
			
						}
						else if ( !requestDone && xhr && (xhr.readyState === 4 || isTimeout === "timeout") ) {					//������󴫵���ɲ���������Ч ��������ʱ��
								requestDone = true;
								xhr.onreadystatechange = da.noop;
				
								status = ( isTimeout === "timeout" ) ? "timeout" : 
																					!da.httpSuccess( xhr ) ? "error" : 
																					s.ifModified && da.httpNotModified( xhr, s.url ) ? "notmodified" : "success";
				
								var errMsg;
				
								if ( status === "success" ) {
									try {																					//����XML document�����쳣
										data = da.httpData( xhr, s.dataType, s );		//�����ӷ�������õ����� process the data (runs the xml through httpData regardless of callback)
									} catch( parserError ) {
										status = "parsererror:������HTTP����ʱ�쳣��";
										errMsg = parserError;												//�������exception����ֵ��errMsg����
									}
								}
				
								if ( status === "success" || status === "notmodified" ) {			//���request״̬Ϊ"δ�޸�"��"�ɹ�",����"��ʱ"��"����"
									if ( !jsonp ) {																//��jsonp��ִ��Success�ص���������Ϊjsonp��������ע��Ļص�����
										da.handleSuccess( s, xhr, status, data );
									}
								}
								else {																												//���request״̬Ϊ"��ʱ"��"����"
									da.handleError( s, xhr, status, errMsg );			//ִ��Error�ص�����
								}
				
								if ( !jsonp ) {																	//��jsonpģʽ����󴥷�Complete����
									da.handleComplete( s, xhr, status, data );
								}
				
								if ( isTimeout === "timeout" ) {								//���request����Ϊ��ʱ���ͽ�xhr��ֹ
									xhr.abort();
								}
				
								if ( s.async ) {																//���Ϊ�첽����xhr�ÿ�
									xhr = null;
								}
						}
			};
	
			try {														//������ֹ������Opera�������request��ֹ��ʱ���ᴥ��onreadystatechange����
				var oldAbort = xhr.abort;
				xhr.abort = function() {
					if ( xhr ) {
						Function.prototype.call.call( oldAbort, xhr );		//��Ϊ��IE7��oldAbort����������call���ԣ��޷�ͨ��oldAbort.call()��ʽ���ã�����ֻ�н���Function.prototype.call()ԭ�ͺ���������
					}
					onreadystatechange( "abort" );											//�ص����涨��ļ�������
					
				};
			} catch( abortError ) {}
	
			if ( s.async && s.timeout > 0 ) {				//�첽���󣬲����г�ʱ����ֵ���룬��ͨ��setTimeout()����������һ����ʱ��
				setTimeout(function() {
					if ( xhr && !requestDone ) {				//�˶����request������Ȼδ��ɣ��ͻص�������ʱ�¼�
						onreadystatechange( "timeout" );
					}
				}, s.timeout);
				
			}
	
			try {																		//����request����
				xhr.send( noContent || s.data == null ? null : s.data );
	
			} 
			catch( sendError ) {										//��������ʽ�����쳣���ʹ���Error������Complete����
				da.handleError( s, xhr, null, sendError );
				da.handleComplete( s, xhr, status, data );
			}
	
			if ( !s.async ) {												//����ͬ������ firefox1.5��������ܴ���onreadystatechange��������Ҫ��Ԥ����
				onreadystatechange();
			}
	
			return xhr;								//����xhr�����Ա���������ֹrequest�������������
		}
	
	});

	//���л���ֵ�Զ༶�Ͳ�����
	/*
		prefix:	��ֵ�Եļ�key
		obj:	��ֵ�Ե�ֵvalue(����Ҳ�Ǽ�ֵ�Զ�������飬�༶)
		traditional:	�Ƿ����ϵķ�ʽ���л�
		add: ���л����ַ���������ʱ����ص���������
	*/
	function buildParams( prefix, obj, traditional, add ) {
		if ( da.isArray(obj) && obj.length ) {																	//�������Ϊ��������
			da.each( obj, function( i, v ) {
				if ( traditional || daRe_bracket.test( prefix ) ) {
					// Treat each array item as a scalar.
					add( prefix, v );
	
				} 
				else {
					// If array item is non-scalar (array or object), encode its
					// numeric index to resolve deserialization ambiguity issues.
					// Note that rack (as of 1.0.0) can't currently deserialize
					// nested arrays properly, and attempting to do so may cause
					// a server error. Possible fixes are to modify rack's
					// deserialization algorithm or to provide an option or flag
					// to force array serialization to be shallow.
					buildParams( prefix + "[" + ( typeof v === "object" || da.isArray(v) ? i : "" ) + "]", v, traditional, add );
				}
			});
				
		}
		else if ( !traditional && obj != null && typeof obj === "object" ) {		//�������Ϊ��ֵ������
			if ( da.isEmptyObj( obj ) ) {
				add( prefix, "" );
			} 
			else {
				da.each( obj, function( k, v ) {
					buildParams( prefix + "[" + k + "]", v, traditional, add );
				});
			}
						
		}
		else {																																	//û��������
			add( prefix, obj );
		}
	}
	
	// This is still on the jQuery object... for now
	// Want to move this to jQuery.ajax some day
	da.extend({
		active: 0,											//�첽���������
	
		// Last-Modified header cache for next request
		lastModified: {},
		etag: {},
	
		handleError: function( s, xhr, status, e ) {
			if ( s.error ) {																			//�����error�ص�����,`��Ҫ����error�ص�����
				s.error.call( s.context, xhr, status, e );
			}

			if ( s.global ) {																			//�����ajaxError�ص�����,`��Ҫ����ajaxError�ص�����
				da.triggerGlobal( s, "ajaxError", [xhr, s, e] );
			}
		},
	
		handleSuccess: function( s, xhr, status, data ) {
			if ( s.success ) {																		//�����success�ص�����,`��Ҫ����success�ص�����
				s.success.call( s.context, data, status, xhr );
			}
	
			if ( s.global ) {																			//��Ҫ����ajaxȫ�ֵ�ajaxSuccess�ص�����,Ĭ��Ϊtrue
				da.triggerGlobal( s, "ajaxSuccess", [xhr, s] );
			}
		},
	
		handleComplete: function( s, xhr, status ) {
			if ( s.complete ) {																		//�����complete�ص�����,`��Ҫ����complete�ص�����
				s.complete.call( s.context, xhr, status );
			}
	
			if ( s.global ) {																			//��Ҫ����ajaxȫ�ֵ�ajaxComplete�ص�����,Ĭ��Ϊtrue
				da.triggerGlobal( s, "ajaxComplete", [xhr, s] );
			}
	
			if ( s.global && da.active-- === 1 ) {								//���첽���������Ϊ 1 ʱ����ajaxȫ�ֵ�ajaxStop�ص�����,Ĭ��Ϊtrue
				da.event.trigger( "ajaxStop" );
			}
		},
			
		triggerGlobal: function( s, type, args ) {							//?????
			(s.context && s.context.url == null ? da(s.context) : da.event).trigger(type, args);
		},
	
		// Determines if an XMLHttpRequest was successful or not
		httpSuccess: function( xhr ) {
			try {
				// IE error sometimes returns 1223 when it should be 204 so treat it as success, see #1450
				return !xhr.status && location.protocol === "file:" || xhr.status >= 200 && xhr.status < 300 || xhr.status === 304 || xhr.status === 1223;
				
			} catch(e) {}
	
			return false;
		},
	
		// Determines if an XMLHttpRequest returns NotModified
		httpNotModified: function( xhr, url ) {
			var lastModified = xhr.getResponseHeader("Last-Modified"),
					etag = xhr.getResponseHeader("Etag");
	
			if ( lastModified ) {
				da.lastModified[ url ] = lastModified;
			}

			if ( etag ) {
				da.etag[url] = etag;
			}
	
			return xhr.status === 304;
		},
		
		httpData: function( xhr, type, s ) {
			var ct = xhr.getResponseHeader("content-type") || "",
					xml = type === "xml" || !type && ct.indexOf("xml") >= 0,
					data = xml ? xhr.responseXML : xhr.responseText;
	
			if ( xml && data.documentElement.nodeName === "parsererror" ) {
				da.error( "parsererror" );
			}
	
			// Allow a pre-filtering function to sanitize the response
			// s is checked to keep backwards compatibility
			if ( s && s.dataFilter ) {
				data = s.dataFilter( data, type );
			}
	
			// The filter can actually parse the response
			if ( typeof data === "string" ) {
				// Get the JavaScript object, if JSON is used.
				if ( type === "json" || !type && ct.indexOf("json") >= 0 ) {
					data = da.parseJSON( data );
	
				// If the type is "script", eval it in global context
				} else if ( type === "script" || !type && ct.indexOf("javascript") >= 0 ) {
					da.globalEval( data );
				}
			}
	
			return data;
		}
	
	});
	
	/*
	 * Create the request object; Microsoft failed to properly
	 * implement the XMLHttpRequest in IE7 (can't request local files),
	 * so we use the ActiveXObject when it is available
	 * Additionally XMLHttpRequest can be disabled in IE7/IE8 so
	 * we need a fallback.
	 */
	if ( window.ActiveXObject ) {
		da.ajaxSettings.xhr = function() {
			if ( window.location.protocol !== "file:" ) {
				try {
					return new window.XMLHttpRequest();
				} catch(xhrError) {}
			}

			try {
				return new window.ActiveXObject("Microsoft.XMLHTTP");
			} catch(activeError) {}
		};
	}

	// Does this browser support XHR requests?
	da.support.ajax = !!da.ajaxSettings.xhr();
	
})(da);
	
/***************** Offset *****************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: Ԫ��λ�ù�����
	version: 1.0.0
*/
(function(da){
	da.offset = {
		initialize: function() {								//����λ����ʽ������ ������������ж� ��ʼ������
			var body = document.body,
					container = document.createElement( "div" ),
					innerDiv, checkDiv, table, td,
					bodyMarginTop = parseFloat( da.curCSS( body, "marginTop", true ) ) || 0,
					strHTML = ["<div style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;'>",
										    "<div></div>",
										 "</div>",
										 "<table style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;' cellpadding='0' cellspacing='0'>",
										    "<tr><td></td></tr>",
										 "</table>"].join("");
	
			da.extend( container.style, { position: "absolute", top: 0, left: 0, margin: 0, border: 0, width: "1px", height: "1px", visibility: "hidden" } );
			container.innerHTML = strHTML;
			body.insertBefore( container, body.firstChild );
			innerDiv = container.firstChild;
			checkDiv = innerDiv.firstChild;
			td = innerDiv.nextSibling.firstChild.firstChild;
	
			this.doesNotAddBorder = (checkDiv.offsetTop !== 5);
			this.doesAddBorderForTableAndCells = (td.offsetTop === 5);	
	
			checkDiv.style.position = "fixed", checkDiv.style.top = "20px";
			// safari subtracts parent border width here which is 5px
			this.supportsFixedPosition = (checkDiv.offsetTop === 20 || checkDiv.offsetTop === 15);
			checkDiv.style.position = checkDiv.style.top = "";
	
			innerDiv.style.overflow = "hidden", innerDiv.style.position = "relative";
			this.subtractsBorderForOverflowNotVisible = (checkDiv.offsetTop === -5);
	
			this.doesNotIncludeMarginInBodyOffset = (body.offsetTop !== bodyMarginTop);							//���body��λ��ƫ���� �Ƿ����marginTop ���ж�
	
			body.removeChild( container );
			body = container = innerDiv = checkDiv = table = td = null;
			
			da.offset.initialize = da.noop;							//������Դ�������ڴ�й¶����ʼ������ֻһ��
		},
	
		getBodyOffset: function( body ) {
			var top = body.offsetTop, left = body.offsetLeft;										//��ʼֵ����Ӧ�ð���body��ƫ��ֵ
	
			da.offset.initialize();				//�ȳ�ʼ�� ����λ����ʽ�ļ������ж�
	
			if ( da.offset.doesNotIncludeMarginInBodyOffset ) {									//�����ǰ�����ƫ��ֵ������marginTop, ȫ��ͳһΪ����body��marginTopֵ
				top  += parseFloat( da.curCSS(body, "marginTop", true) ) || 0;
				left += parseFloat( da.curCSS(body, "marginLeft", true) ) || 0;
			}
	
			return { top: top, left: left };
		},
		
		//����DOM�����ƫ������
		/*
			obj: Ŀ�����
			options: 
			i: 
		*/
		setOffset: function( obj, options, i ) {
			if ( /static/.test( da.curCSS( obj, "position" ) ) ) {							//������ƫ��λ��ʱҪ��֤position����Ϊ��static, Ĭ������Ϊrelative
				obj.style.position = "relative";
			}
			var curElem	= da( obj ),
					curOffset = curElem.offset(),
					curTop = parseInt( da.curCSS( obj, "top",  true ), 10 ) || 0,
					curLeft = parseInt( da.curCSS( obj, "left", true ), 10 ) || 0;
	
			if ( da.isFunction( options ) ) {
				options = options.call( obj, i, curOffset );
			}
	
			var pos = {
				top:  (options.top  - curOffset.top)  + curTop,
				left: (options.left - curOffset.left) + curLeft
			};
	
			if ( "using" in options ) {															//��֪����ʲô���������????????????
				options.using.call( obj, pos );
			}
			else {
				curElem.css( pos );
			}
		}
	};
	
	da.fnStruct.extend({
			pos: function(){
					if ( !this.dom[0] ) {
						return null;
					}
			
					var elem = this.dom[0],
			
					// Get *real* offsetParent
					offsetParent = this.posInParent(),
					// Get correct offsets
					offset = this.offset(),
					parentOffset = /^body|html$/i.test(offsetParent.dom[0].nodeName) ? { top: 0, left: 0 } : offsetParent.offset();
					
					// Subtract element margins
					// note: when an element has margin: auto the offsetLeft and marginLeft
					// are the same in Safari causing offset.left to incorrectly be 0
					offset.top  -= parseFloat( da.curCSS(elem, "marginTop",  true) ) || 0;
					offset.left -= parseFloat( da.curCSS(elem, "marginLeft", true) ) || 0;
					
					// Add offsetParent borders
					parentOffset.top  += parseFloat( da.curCSS(offsetParent.dom[0], "borderTopWidth",  true) ) || 0;
					parentOffset.left += parseFloat( da.curCSS(offsetParent.dom[0], "borderLeftWidth", true) ) || 0;
					
					// Subtract the two offsets
					return {
						top:  offset.top  - parentOffset.top,
						left: offset.left - parentOffset.left
					};
			},
			
			posInParent: function(){
					return this.map(function() {
							var offsetParent = this.offsetParent || document.body;
							while ( offsetParent && (!/^body|html$/i.test(offsetParent.nodeName) && da.css(offsetParent, "position") === "static") ) {
								offsetParent = offsetParent.offsetParent;
							}
							return offsetParent;
							
					});
			},
			
			//����DOMԪ�ص�ƫ��λ�ã�Ŀ�������� Ҫ��left��top��ʽ���ԣ�
			/*
				options: left��top��ֵ��
			*/
			offset: function( options ){
				var obj = this.dom[0];
			
				if ( options ) {																	//����ȫ����
					return this.each(function( i ) {
						da.offset.setOffset( this, options, i );
					});
				}
			
				if ( !obj || !obj.ownerDocument ) {								//���DOM����û��д���κ�һ��documentֱ�ӷ��ؿ�
					return null;
				}
			
				if ( obj === obj.ownerDocument.body ) {						//����Ǽ���body��ƫ��ֵ, ֱ�ӵ���da.offset.getBodyOffset() ����
					return da.offset.getBodyOffset( obj );
				}
			
				var box = obj.getBoundingClientRect(),
						doc = obj.ownerDocument,
						body = doc.body,
						docElem = doc.documentElement,
					
						clientTop = docElem.clientTop || body.clientTop || 0,
						clientLeft = docElem.clientLeft || body.clientLeft || 0,
						top  = box.top  + (self.pageYOffset || da.support.boxModel && docElem.scrollTop  || body.scrollTop ) - clientTop,
						left = box.left + (self.pageXOffset || da.support.boxModel && docElem.scrollLeft || body.scrollLeft) - clientLeft;
			
				return { top: top, left: left };
			}
	
	});
	
	da.each( {scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function( method, prop ) {
		var top = /Y/.test( prop );

		da.fnStruct[ method ] = function( val ) {
			return da.access( this, function( elem, method, val ) {
				var win = getWindow( elem );

				if ( val === undefined ) {
					return win ? (prop in win) ? win[ prop ] :
						win.document.documentElement[ method ] :
						elem[ method ];
				}

				if ( win ) {
					win.scrollTo(
						!top ? val : da( win ).scrollLeft(),
						 top ? val : da( win ).scrollTop()
					);

				} else {
					elem[ method ] = val;
				}
			}, method, val, arguments.length, null );
		};
	});

	function getWindow( elem ) {
		return da.isWin( elem ) ?
			elem :
			elem.nodeType === 9 ?
				elem.defaultView || elem.parentWindow :
				false;
	}

})(da);

/***************** Size *****************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: Ԫ�سߴ��С������
	version: 1.0.0
*/
(function(da){
	//DOM���� λ�óߴ� ����������չ
	//��Ϊwidth��height����ֵ�Ļ�ȡ�������ƣ�����ͨ��each������������չda���height() �� width()����
	da.each([ "Height", "Width" ], function( i, name ) {
	
		var type = name.toLowerCase();													//"height" �� "width"
	
		da.fnStruct["inner" + name] = function() {							//��da������չ innerHeight �� innerWidth����
			return this.dom[0] ? parseFloat( da.css( this.dom[0], type, "padding" ) ) : null;
		};
	
		da.fnStruct["outer" + name] = function( margin ) {			//��da������չ outerHeight and outerWidth����
			return this.dom[0] ? parseFloat( da.css( this.dom[0], type, margin ? "margin" : "border" ) ) : null;
		};
		
		//��da����չ��Ӧ��height() �� width()����
		/*
			size:	Ŀ��DOM���� �ߴ�ֵ��������
		*/
		da.fnStruct[ type ] = function( size ) {
			var obj = this.dom[0];
			if ( !obj ) {
				return size == null ? null : this;									//���û��Ŀ��DOM���󣬷���this����
			}
			
			//getģʽ
			if ( da.isFunction( size ) ) {												//���size�ǻص������ķ�ʽ�������ȡ���dom�ĸ߿����ݣ���ͨ��each��������ã��ڻص��������ش�����ٴε�����Ӧheight() �� width()����
				return this.each(function( i ) {
					var objSelf = da( this );
					objSelf[ type ]( size.call( this, i, objSelf[ type ]() ) );			//�ص�����Ĭ�ϻش�dom����dom���������š���ǰheight��widthֵ��������
				});
			}
			
			if ( da.isWin( obj ) ) {										//���Ŀ������Ǵ���
				// Everyone else use document.documentElement or document.body depending on Quirks vs Standards mode
				return ( obj.document.compatMode === "CSS1Compat" && obj.document.documentElement[ "client" + name ] ) 
				|| obj.document.body[ "client" + name ];
	
			}
			else if ( da.isDoc( obj ) ) {								//���Ŀ�������document ��nodeType�� 1=Ԫ��element�� 2=����attr�� 3=�ı�text�� 8=ע��comments�� 9=�ĵ�document��
					return Math.max(
						obj.body["scroll" + name],
						obj.body["offset" + name],
						obj.documentElement["client" + name],
						obj.documentElement["scroll" + name],
						obj.documentElement["offset" + name]
					);
	
			}
			
			else if ( size === undefined ) {							//���û�д��� �ߴ�ֵ�������� ��ֱ�ӷ�������
					var tmpv = da.css( obj, type ), ret = parseFloat( tmpv );
		
					return da.isNaN( ret ) ? tmpv : ret;
	
			}
			
			//setģʽ
			else{
				return this.css( type, typeof size === "string" ? size : size + "px" );
			}
		};
	
	});
	
})(da);

/***************** Timer *******************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: ȫ�ּ�ʱ��
	version: 1.0.0
*/
(function(da){
	da.extend({
		queueHandle: [],
		timer_queueHandle: null,
		
		startHandle: function(){
			var context = this;
			
			da.timer_queueHandle = setInterval(function(){
				if( 0 >= da.queueHandle.length ) da.stopHandle();
				
				var timeNow = new Date().getTime(),
					item;

				for(var i=0,len=da.queueHandle.length; i<len; i++){			//ѭ��timer����
					item = da.queueHandle[i];
					
					if( item && item.delay <= (timeNow - item.prevTime ) ){
						item.handle.apply( context, item.params );
						
						if( "timer" === item.type ){
							da.queueHandle.splice(i, 1);
						}
						else if( "keep" === item.type ){
							item.prevTime = new Date().getTime();
						}
					}
				}
			},1);
		},
		
		stopHandle: function(){
			da.queueHandle = [];
			if( da.timer_queueHandle ) clearInterval( da.timer_queueHandle );
		},
		
		/**�����հ���װ��setInterval �� setTimeout������ͨ��call��Ƕ��this�����ģ�thisĬ��Ϊda�� ��
		* delay ִ����ʱ( Ĭ������setTimeout����ӡ�_loop����׺����setInterval )
		* fn �Զ���ص�����
		* params �ص��������
		*/
		timer: function( /*delay, fn, params*/ ){
			if( 2 > arguments.length ) return;
			if( !da.isFunction( arguments[1] ) ) return;
			
			var arrTmp = arguments[0].toString().split("_");
			
			var item = {
				type: (arrTmp[1] && "loop" == arrTmp[1]) ? "keep" : "timer",		//����
				delay: parseInt(arrTmp[0],10) || 13,								//����
				prevTime: new Date().getTime(),										//��һ��ִ��ʱ��
				handle: arguments[1],												//�Զ��崦����
				params: [].slice.call( arguments, 2 )								//�޳�ǰ����������
			};

			da.queueHandle.push( item );
			da.startHandle();
			
			return da.queueHandle.length -1;
		},
		
		/**�����հ���װ��setInterval������ͨ��call��Ƕ��this�����ģ�thisĬ��Ϊda�� ��
		* delay ִ����ʱ
		* fn	�Զ���ص�����s
		* params �ص��������
		*/
		keep: function( /*delay, fn, params*/ ){
			arguments[0] += "_loop";
			return da.timer.apply( this, arguments );
		},
		
		clearTimer: function( idx ){
			da.queueHandle.splice(idx, 1);
		},

		clearKeep: function( idx ){
			da.queueHandle.splice(idx, 1);
		}

	});
	

})(da);

/***************** ���ܽ��� *************************************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: ���ܽ��ܡ��������
	version: 1.0.0
*/
(function(da){
	//��Կ
	var codeKey = "1Q2AqzWaYxZdXswcf3SgvpC45EKbehDVoj6Tn7LBk8OFmRrGlUyNui9IHPtMJ0",
	
	//���� תΪ ����
	toChar = function( arrTmp, idx ){
		arrTmp[ arrTmp.length ] = codeKey.charAt( idx );
	},
	
	//���� תΪ ����
	toIdx = function( code, char ){
		return codeKey.indexOf( char );
	};
	
	da.extend({
		//����
		code: function( str ){
				if( 0 <= str.indexOf( "*da*" ) ) return str;		//���ܹ��Ͳ��ü�����
				
				var len = str.length,										//Դ�ַ�������
						arrTmp=[],res,
					  kLen = codeKey.length,			//��Կ�� ����
					  klen2 = kLen * kLen,								//��Կ�� 2������
					  klen5 = kLen * 5;										//��Կ�� 5������
			  
				for( var i=0,a; i < len; i++ )
				{
					a = str.charCodeAt(i);																	//���ȡ��Դ�ַ����� �ַ�
					
					if( a < klen5 ){
							toChar( arrTmp, Math.floor( a / kLen ));				//С�ڵ�������ֵ�������������( �������� )
							toChar( arrTmp, a % kLen );
					}
					else{
						toChar( arrTmp, Math.floor( a / klen2 ) + 5 );
						toChar( arrTmp, Math.floor( a / kLen ) % kLen );
						toChar( arrTmp, a % kLen );
					}
				}
				res = arrTmp.join("");
				
				return "*da*" + String( res.length ).length + String( res.length ) + res;				//��һλ��������ַ�������ֵ��λ�������9λ����ͨ����һλ��ֵ��ȡ�ñ�����ַ�������ֵ��Ȼ��ʣ�µ��Ǳ������ַ�����ǰ������Զ������ͷ*da*
																																												//�磺31771G1O1s1Z1o1o1o1����y191s1Z����1G1s1Z  �����ͣ�3 - "177"�ĳ��ȡ�  177 - ������ַ����ȣ�
		},
		
		//����
		decode: function( code ){
				if( 0 != code.indexOf( "*da*" ) ) return code;		//����ͷ����,��ȥ������ͷ
				code = code.substr( 4 );
				
				var nlen = code.charAt( 0 ) * 1;			//ȥ��һλ�ַ�����ͨ���������ʽת��Ϊ����
				if( isNaN( nlen ) ) return "";				//ͨ��isNaN()�����ж��Ƿ���� ������Ϣ��ʽ
				
				nlen = code.substr( 1, nlen ) * 1;		//ȡʵ�ʱ����ַ�������ֵ
				if( isNaN( nlen ) ) return code;				
				
				var clen = code.length,								//ȡ�������봮���ȣ������˳�����Ϣλ��
						arrTmp = [],a,f,b,
						i = String( nlen ).length + 1,		//���ϵ�һλ��������Ϣֵ�� λ����Ϣ��
						kLen = codeKey.length;					//��Կ�� ����
						
				if( clen != i + nlen ) return code;		//ƥ��ʵ�ʱ����ַ����� �� ������Ϣ �Ƿ�һ��

				while( i < clen )
				{
					a = toIdx( code, code.charAt( i++ ) );
					if( a < 5 ) 
						f = ( a * kLen ) + toIdx( code, code.charAt( i ) );
					else
						f = ( ( a - 5 ) * kLen * kLen ) + ( toIdx( code, code.charAt( i ) ) * kLen ) + toIdx( code, code.charAt( ++i ) );
				 	
				 	arrTmp[ arrTmp.length ] = String.fromCharCode( f );
				 	i++;
				}
				
				return arrTmp.join( "" );
		},
		
		//����
		toHex: function( str ) {
			str = da.isNull( str.toString(), "" );
			
			if ("" != str) {
				if (0 == str.indexOf('~h`')) return str;
				
				var code, rs = [];
				
				for (var i=0, len=str.length; i<len; i++ ) 
				{
					code = str.charCodeAt(i).toString(16);				//���ַ�תΪ16�����ַ���
					code = da.zeroFill( code, 4 );						//4λ16����,��������
					
					rs.push( code.slice(2, 4) + code.slice(0, 2) );		//�ߵ�λ�ߵ�����
				}
				return ('~h`' + rs.join(""));
			}
			
			return str;
		},
		
		//����
		toStr: function ( hex ){
			hex = da.isNull( hex, "" );
			
			if (0 == hex.indexOf('~h`')) {
				hex = hex.substr(3);									//ȥǰ׺
				
				if ( "" != hex ) {
					var str='', rs = [];
					
					for (var i=1, offset=0; i <=hex.length/4; i++ ){
						offset = 4 * i;
					
						rs[i * 3 - 3] = "%u" ;
						rs[i * 3 - 2] = hex.slice( offset-2, offset );
						rs[i * 3 - 1] = hex.slice( offset-4, offset-2 );
					};
					str = unescape(rs.join(""));
					return str;
				}
				return "";
			}
			return hex;
		}
	});
})(da);

/***************** ���ֲ� **************************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: ���ֲ�
	version: 1.0.0
*/
(function(da){
	function fnProp(n) {
	  return n && n.constructor === Number ? n + 'px' : n;
	}
	
	da.fnStruct.extend({
			bgiframe: function( params ){
				var def = {
					top: "auto",
					left: "auto",
					width: "auto",
					height: "auto",
					opacity: true,
					src: "about:blank"
				};
		    
		    params = da.extend( {}, def, params );
		    
			var iframeObj, overObj, doc,
				css = "display:block; position:absolute; z-index:-1; background:transparent; top:0px; left:0px; width:100%; height:100%;" ;
			
		    this.each( function(){
                    doc = this.ownerDocument;
                    
				    iframeObj = doc.createElement("iframe");
				    iframeObj.src = params.src;
				    iframeObj.className = "daBgIframe";
				    iframeObj.setAttribute( "frameborder", 0, 0 );
				    iframeObj.setAttribute( "tabindex", -1 );
				    iframeObj.style.cssText = [
				   		css, 
				   		( params.opacity === true ? 'filter:Alpha(Opacity=\'0\');' : '' )
				   	].join("");
				   	
//				    iframeObj.style.cssText = [
//				    	"display:block;position:absolute;z-index:-1;background:transparent;",
//              ( params.opacity !== false ? 'filter:Alpha(Opacity=\'0\');' : '' ),
//				    	'top:', ( 'auto' == params.top ? 'expression(((parseInt(this.parentNode.currentStyle.borderTopWidth)||0)*-1)+\'px\')' : fnProp(params.top) ),
//					    ';left:', ( 'auto' == params.left ? 'expression(((parseInt(this.parentNode.currentStyle.borderLeftWidth)||0)*-1)+\'px\')' : fnProp(params.left)),
//							';width:', ( 'auto' == params.width ? 'expression(this.parentNode.offsetWidth+\'px\')' : fnProp(params.width)),
//							';height:', ( 'auto' == params.height ? 'expression(this.parentNode.offsetHeight+\'px\')' : fnProp(params.height)), 
//							";"
//						].join("");
						
				    overObj = doc.createElement("div");
				    overObj.style.cssText = [
				   		css, 
				   		( params.opacity === true ? 'filter:Alpha(Opacity=\'0\');' : '' )
				   	].join("");
//				    overObj.style.cssText = [
//				    	"display:block;position:absolute;z-index:-1;border:1px solid #0f0;background:transparent;",
//              ( params.opacity !== false ? 'filter:Alpha(Opacity=\'0\');' : '' ),
//				    	'top:0', //( 'auto' == params.top ? 'expression(((parseInt(this.parentNode.currentStyle.borderTopWidth)||0)*-1)+\'px\')' : fnProp(params.top) ),
//					    ';left:0', //( 'auto' == params.left ? 'expression(((parseInt(this.parentNode.currentStyle.borderLeftWidth)||0)*-1)+\'px\')' : fnProp(params.left)),
//							';width:', ( 'auto' == params.width ? 'expression(this.parentNode.offsetWidth+\'px\')' : fnProp(params.width)),
//							';height:', ( 'auto' == params.height ? 'expression(this.parentNode.offsetHeight+\'px\')' : fnProp(params.height)), 
//							";"
//						].join("");

		        if( 0 === da(this).children('iframe.daBgIframe').dom.length ){
		        	this.insertBefore( overObj, this.firstChild );
		        	this.insertBefore( iframeObj, this.firstChild );
		        }
		    });
		    
		    defParams = null;
		    iframeObj = null;
	
		    return this;
			}
	});
	
	da.extend({
			//��ʼ�����ֲ����		//body��onLoad�¼�������
			/*
				zIndex: ��ʾ���ǵ�z����
			*/
			daMaskInit: function( maskWin, zIndex ){
				maskWin = maskWin || window;
				var maskDoc = maskWin.document,
						objMask = maskDoc.createElement("div");
						
				objMask.id = 'daMask';
				objMask.style.cssText = 'position:absolute; top:0px; left:0px; display:none; background:#000; filter: Alpha(opacity=50);/* IE */ -moz-opacity:0.5;/* FF ��Ҫ��Ϊ�˼����ϰ汾��FF */ opacity:0.5;/* FF */';
				
				objMask.style.zIndex = zIndex || 19998;								//�������ʾ�㼶Ӧ����С��daWin����ڣ�����daWin�ǻ����
				
				objMask.style.width = Math.max( da( maskWin ).width(), maskDoc.body.scrollWidth, maskDoc.documentElement.scrollWidth )+ "px";
				objMask.style.height = Math.max( da( maskWin ).height(), maskDoc.body.scrollHeight, maskDoc.documentElement.scrollHeight )+ "px";
	//				da( objMask ).bind("mousedown",function(){
	//					da.daMaskHide(maskWin);
	//				});
				maskDoc.body.insertBefore(objMask);
				
				da(objMask).bgiframe();
				
				//body��С�ı�ʱ���������ֲ���³ߴ纯��
				da( maskWin ).bind( "resize", function(){
					da.daMaskFresh( this );
				});
				
				return objMask;
			},
			
			//�Ƿ��Ѿ���ʼ��
			daGetMask: function( maskWin ){
				maskWin = maskWin || window;
				var objMask = maskWin.document.getElementById("daMask");
				if(null==objMask) return false;
				else return objMask;
			},
			
			//�������ֲ�����С�ߴ�   //body��onResize�¼�������
			daMaskFresh: function( maskWin ){
				maskWin = maskWin || window;
				var maskDoc = maskWin.document,
						objMask = da.daGetMask( maskWin );
				if( !objMask ) objMask = da.daMaskInit( maskWin );
				
				objMask.style.width = Math.max( da( maskWin ).width(), maskDoc.body.scrollWidth, maskDoc.documentElement.scrollWidth ) + "px"; 
				objMask.style.height = Math.max( da( maskWin ).height(), maskDoc.body.scrollHeight, maskDoc.documentElement.scrollHeight ) + "px"; 
				
				//this.daMaskShow( maskWin );
			},
			
			//��ʾ���ֲ�
			/*
				zIndex: ��ʾ���ǵ�z����
			*/
			daMaskShow: function( maskWin, opacity, color, zIndex ){
				maskWin = maskWin || window;
				var maskDoc = maskWin.document,
						objMask = da.daGetMask( maskWin );
				if( !objMask ) objMask = da.daMaskInit( maskWin );
				
				da.daMaskFresh( maskWin );
				
				objMask.style.background = color || "#000";
				objMask.style.filter = "Alpha(opacity="+ (opacity || 50) +")";
				objMask.style.opacity = ( opacity || 50 )/100;
				//objMask.style.mozOpacity = opacity || 0.5;
				objMask.style.zIndex = zIndex || 19998;									//�������ʾ�㼶Ӧ����С��daWin����ڣ�����daWin�ǻ����
				
				if( "undefined" !== typeof daFx )
					da( objMask ).fadeIn(300);
				else
					objMask.style.display = "block";
				
			},
			
			//�������ֲ�
			daMaskHide: function( maskWin ){
				maskWin = maskWin || window;
				var objMask = da.daGetMask( maskWin );
				if( !objMask ) return;
				
	//				if( "undefined" !== typeof daFx )															//�첽�������׳�����
	//					da( objMask ).fadeOut(300);
	//				else
					objMask.style.display = "none";
					
			}
		
	});
})(da);

/***************** Tools ���� *****************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: �⹦�ܺ���
	version: 1.0.0
*/
(function(da){
	da.extend({
		//��ȡ��������ͺͰ汾
		browser: (function(){
			var Sys = {},
					ua = navigator.userAgent.toLowerCase(),
					s;
			(s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :
			(s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :
			(s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :
			(s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :
			(s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;
			
			return Sys;
		})(),
		
		//���������ܲ���ʱʹ����testA()��testB()����֮�䣬����Ҫ���ԵĴ�������ʱ��(�첽������Ч)
		testTime: null,
		
		//��ʼ
		testA: function(){
			da.testTime = new Date();
		},
		
		//��ֹ������ʱ�����Ϣ
		testB: function(){
			var now = new Date();
			return ["��ʱ��",(now - da.testTime),"ms"].join("");
		},
		
		//��������ݷ��������
		copy: function(sText,sTitle){
			sTitle = sTitle || "Text";
			
			if (window.clipboardData) {				//IE
				window.clipboardData.clearData();   
			  return ( window.clipboardData.setData( sTitle,sText ) );			//���Ƶ�������
			}
			else if(navigator.userAgent.indexOf("Opera") != -1) {    
				window.location = sText;    
			}
			else if (window.netscape) {
			try{
				netscape.security.PrivilegeManager.enablePrivilege( "UniversalXPConnect" );    
			}
			catch(e){
				alert("��������ܾ���\n�����������ַ������'about:config'���س�\nȻ��[ signed.applets.codebase_principal_support ]����Ϊ'true'");
				return false;
			}    
			var clip = Components.classes[ '@mozilla.org/widget/clipboard;1' ].createInstance( Components.interfaces.nsIClipboard );    
			if ( !clip ) return;    
			var trans = Components.classes[ '@mozilla.org/widget/transferable;1' ].createInstance( Components.interfaces.nsITransferable );    
			if ( !trans ) return;    
			trans.addDataFlavor( 'text/unicode' );    
			var str = new Object(),
					len = new Object(),
					copytext = sText;
			
			str = Components.classes[ "@mozilla.org/supports-string;1" ].createInstance( Components.interfaces.nsISupportsString );
			str.data = copytext;    
			trans.setTransferData( "text/unicode", str, copytext.length*2 );    
			var clipid = Components.interfaces.nsIClipboard;
			
			if ( !clip ) return false;
			clip.setData( trans, null, clipid.kGlobalClipboard );    
			alert( "���Ƴɹ���" )    
			}

			return false;
		},
		
		//���������Ϣ
		/*
			msg: ������Ϣ
			color: ������Ϣ����ɫ
		*/
		out: function( msg, color ){
			color = color || "#ffff99";
			
			var pushWin = da.getRootWin() || window,
				pushDoc = pushWin.document,
				outDiv = pushDoc.getElementById("daDebugOutDiv"),
				lineObj;
			
			if( null === outDiv ){

				var containerDiv, titleDiv, closeDiv;
				
				containerDiv = pushDoc.createElement("div");
				containerDiv.className = "daShadow";
				containerDiv.style.cssText= "position:fixed; z-Index:99999; width:800px; padding:30px 5px 5px 5px; background:#555;";
				containerDiv.style.left = (da(pushWin).width() - 800)/2 +"px";
				containerDiv.style.top = "0px";
				pushDoc.body.insertBefore( containerDiv, pushDoc.body.firstChild );
				
				titleDiv = pushDoc.createElement("div");
				titleDiv.style.cssText= "position:absolute;left:5px;top:0px;height:30px;line-height:30px;width:100%;font-size:12px;text-indent:10px; color:#f0f0f0;";
				titleDiv.innerHTML = "������Ϣ";
				containerDiv.insertBefore( titleDiv, null );
				
				outDiv = pushDoc.createElement("div");
				outDiv.id = "daDebugOutDiv";
				outDiv.style.cssText= "border-bottom: 1px solid #444; background:#f0f0f0;width:100%; height:200px; overflow:scroll;";
				containerDiv.insertBefore( outDiv, null );
				
				closeDiv = pushDoc.createElement("div");
				closeDiv.style.cssText= "position:absolute;right:5px;top:5px;padding:2px;cursor:pointer;color:#f0f0f0;border:1px solid #666";
				closeDiv.innerHTML = "Close";
				containerDiv.insertBefore( closeDiv, null );
				
				da( closeDiv ).bind( "click",function( evt ){
					if( "Close" === this.innerHTML ){
						outDiv.style.display = "none";
						containerDiv.style.width = "100px";
						this.innerHTML = "Open";
					}
					else{
						outDiv.style.display = "block";
						containerDiv.style.width = "800px";
						this.innerHTML = "Close";
					}
				});
				
				if( "undefined" != typeof daDrag ){
					daDrag({
						src: titleDiv,
						target: containerDiv,
						before: function(){
							da.daMaskShow(pushWin,1);
							containerDiv.className = "";
						},
						move: function( evt, src, target, oldPos, nowPos, dragPStart, dragPEnd ){
							var winHeight = da(pushWin).height();
							
							if( 0 > nowPos.y )
								nowPos.y = 0;
							else if( winHeight - 50 < nowPos.y )
								nowPos.y = winHeight - 50;
						},
						after: function(){
							da.daMaskHide();
							containerDiv.className = "daShadow";
						}
					});
				}

			}
			
			if( da.isArray( msg ) ){							//�ж��Ƿ�Ϊ����
				for( var i=0,len=msg.length; i<len; i++ ){
					lineObj = pushDoc.createElement("div");
					lineObj.style.backgroundColor = color;
					lineObj.innerHTML = msg[i];
					outDiv.insertBefore( lineObj, outDiv.firstChild );
				}
			}
			else if( /<|&#?\w+;/.test( msg ) ){					//�ж��Ƿ���Ԫ�ر�ǩ
				lineObj = pushDoc.createElement("textarea");
				lineObj.value = "���룺\n" + msg;
				lineObj.style.cssText= "width:80%;height:150px;margin:5px;border:2px solid #663300;background-color:"+color;
				outDiv.insertBefore( lineObj, outDiv.firstChild );
			}
			else{
				lineObj = pushDoc.createElement("div");
				lineObj.style.backgroundColor = color;
				lineObj.innerHTML = msg;
				outDiv.insertBefore( lineObj, outDiv.firstChild );
			}
			
		},
		
		box: function( params ){
			var def = {
					id: "",
					content: null,
					width: 400,
					height: 300,
					title: "",
					color: "#f0f0f0",
					bordercolor: "#999"
				};
			params = da.extend({}, def, params);
			if( "" == params.id ) return;
			
			var boxObj = document.getElementById(params.id);
			
			if( null != boxObj ){
				boxObj.style.display = "";
			}
			else{
				var containerDiv, titleDiv, closeDiv, mainDiv;
				
				containerDiv = document.createElement("div");
				containerDiv.id = params.id;
				containerDiv.className = "daShadow";
				containerDiv.style.cssText = "position:fixed; z-index:999999; border:5px solid; background:#fff;";
				containerDiv.style.width = params.width +"px";
				containerDiv.style.height = params.height +"px";
				containerDiv.style.left = (da(window).width() - params.width)/2 +"px";
				containerDiv.style.top = (da(window).height() - params.height)/2 +"px";
				containerDiv.style.borderColor = params.bordercolor;
				
				titleDiv = document.createElement("div");
				titleDiv.style.cssText = "height:30px; text-indent:10px; font-size:14px; font-weight:bold;";
				titleDiv.style.backgroundColor = params.bordercolor;
				titleDiv.style.color = params.color;
				titleDiv.innerHTML = params.title;
				containerDiv.insertBefore( titleDiv, null );
				
				closeDiv = document.createElement("div");
				closeDiv.style.cssText= "position:absolute; right:5px; top:0px; color:#fff; line-height:25px; font-size:25px; font-family:arial; cursor:pointer;";
				closeDiv.style.color = params.color;
				closeDiv.innerHTML = "X";
				closeDiv.title = "�ر�";
				containerDiv.insertBefore( closeDiv, null );
				
				da( closeDiv ).bind( "click",function( evt ){
					containerDiv.style.display = "none";
				});
				
				if( "undefined" != typeof daDrag ){
					daDrag({
						src: titleDiv,
						target: containerDiv,
						before: function(){
							da.daMaskShow(window,1);
							containerDiv.className = "";
						},
						move: function( evt, src, target, oldPos, nowPos, dragPStart, dragPEnd ){
							var winHeight = da(window).height();
							
							if( 0 > nowPos.y )
								nowPos.y = 0;
							else if( winHeight - 50 < nowPos.y )
								nowPos.y = winHeight - 50;
						},
						after: function(){
							da.daMaskHide();
							containerDiv.className = "daShadow";
						}
					});
				}
				
				mainDiv = document.createElement("div");
				mainDiv.style.cssText = "overflow:hidden;";
				mainDiv.style.width = params.width +"px";
				mainDiv.style.height = (params.height-30) +"px";

				if( "string" == typeof params.content ){
					if( 0 == params.content.indexOf("#") )
						mainDiv.insertBefore( da(params.content).dom[0], null );
					else
						mainDiv.innerHTML = params.content;
				}
				else if( "undefined" != typeof params.content.nodeType)
					mainDiv.insertBefore( params.content, null );
					
				containerDiv.insertBefore( mainDiv, null );
				
				document.body.insertBefore( containerDiv, document.body.firstChild );
			}
		},
		
		boxhide: function( id ){
			var boxObj = document.getElementById(id);
			
			if( null != boxObj ){
				if( "undefined" !== typeof daFx )
					da( boxObj ).fadeOut(300);
				else
					boxObj.style.display = "none";
			}
		},
		
		boxshow: function( id ){
			var boxObj = document.getElementById(id);
			
			if( null != boxObj ){
				if( "undefined" !== typeof daFx )
					da( boxObj ).fadeIn(300);
				else
					boxObj.style.display = "";
			}
		},
		
		focus: function( fromobj, toobj ){
			if("undefined" == typeof daFx) return;
			
			var focusobj = da("#_da_focusbox");
			if( 0>=focusobj.dom.length ){
				obj = document.createElement("div");
				obj.id = "_da_focusbox";
				obj.style.cssText = "display:none; position:absolute; top:0px; left:0px; width:200px; height:100px; border:3px solid #666;";
				document.body.insertBefore(obj, null);
				focusobj = da(obj);
			}
		
			var fromPos = da(fromobj).offset(),
				toPos = da(toobj).offset(),
				fromSize = {width:da(fromobj).width(), height:da(fromobj).height()},
				toSize = {width:da(toobj).width(), height:da(toobj).height()};
			
			focusobj.css({
				width: fromSize.width + "px",
				height: fromSize.height + "px",
				left: fromPos.left + "px",
				top: fromPos.top + "px"
			});
			
			focusobj.show();
			focusobj.act({
				width: toSize.width,
				height: toSize.height,
				left: toPos.left + "px",
				top: toPos.top + "px"
			}, 500, "easeOutQuad",function(){
				focusobj.fadeOut();
			});
		},
		
		//���û��ȡcookie
		cookie: function( name, value, expires, path, domain, se3cure ) {
				//get����
				if( undefined == value ){
					var start = document.cookie.indexOf( name + "=" ),
						len = start + name.length + 1;
						
						if ( start == -1 ) return null;													//û���ҵ���Ӧname��cookie;
					if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ) return null;			//�ҵ������ǵ�һ��,��������Ƕ�Ӧ��name
					
					var end = document.cookie.indexOf( ';', len );					//da�Զ���cookieĬ�ϸ�ʽ,��Ч�ڡ�·���Ȳ�����ͨ��"��"�ָ���,ȡֵֻ��ȡ����һ���ֺ�Ϊֹ
					if ( end == -1 ) end = document.cookie.length;					//���û�а�daĬ�ϸ�ʽ"��",��ֱ��ȡ��
					
					return unescape(document.cookie.substring(len, end));
				}
				//set����
			var expires_date = null,
					today = new Date();																	//��ȡ��ǰʱ��
			
			today.setTime(today.getTime());
			if (expires) expires = expires * 1000 * 60 * 60 * 24;		//��Чʱ�� ��λ��
			expires_date = new Date( today.getTime() + ( expires ) );
			
			document.cookie = [
					name, "=", escape(value),
					( ( expires ) ? ';expires=' + expires_date.toGMTString() : '' ),
					( ( path ) ? ';path=' + path : ''),
					( ( domain ) ? ';domain=' + domain : '' ),
					( ( secure ) ? ';secure' : '' )
			].join("");
			
		},
		
		//ɾ��cookie
		removeCookie: function(name, path, domain) {
			if (da.cookie(name))
				document.cookie = name + '=' + ((path) ? ';path=' + path: '') + ((domain) ? ';domain=' + domain: '') + ';expires=Thu, 01-Jan-1970 00:00:01 GMT';
		},
		
		//Ԥ����ͼƬ
		/*
			url:	ͼƬ��ַ
			callback:	������ϻص�����
		*/
		loadImage: function( url, fn ) {
		  var img = new Image(); 			//����һ��Image����ʵ��ͼƬ��Ԥ����
		  img.src = url;
		  if( !da.isFunction(fn) ) return;
		  
		  if (img.complete) { 				// ���ͼƬ�Ѿ���������������棬ֱ�ӵ��ûص�����
			fn.call(img);
		  }
			else{
			  da( img ).bind( "load", function () { 	//ͼƬ�������ʱ�첽����callback������
					fn.call(img);													//���ص�������this�滻ΪImage����
			  });
			}
		},
		
		/**�����
		* Min: ��Χ��Сֵ
		* Max: ��Χ���ֵ
		*/
		random: function (Min,Max){
			Min = Min || 0;			//Ĭ�Ϸ�Χ
			Max = Max || 100;
			var Range = Max - Min;					//��Χ
			var Rand = Math.random();				//0~1���ֵ
			var addNum = Rand * Range;			//����
			return(Min + Math.round(Rand * Range));
		},
		
		/**����
		*/
		zeroFill: function ( str, len, isRight ){
			if( "number" === typeof str ) str = str.toString();
			var nZero = len - str.length,
				sZero = [];
			
			if( 0 >= nZero ) return str;
			else{
				for( ; 0<nZero; nZero-- ) sZero.push("0");

				if( isRight ) return str = str + sZero.join("");  
				else return str = sZero.join("") + str;
			}
		},
		
		
		//��ȡurl����
		/*
			url:	��ַ��
		*/
		urlParams: function( url ){
			url = url || location.search.substring(1);      		//��ȡҪ��ѯ��url��ַ��
			
			var	arrPair = url.split(/[\&\?]/g),              		//�п�����
				args = {}, idx;
			 
			 for(var i=0; i < arrPair.length; i++) {
				idx = arrPair[i].indexOf('=');         				//ͨ��"="���ֲ���
				if (idx == -1) continue;                   			//û���ҵ�"="����,ֱ������
				 
				 var argName = arrPair[i].substring( 0, idx ); 		//��ȡ������
				 var argValue = arrPair[i].substring( idx + 1 );	//��ȡ����ֵ
				 //value = decodeURIComponent(value);        		//�����Ҫ���Ա���
				 args[argName] = argValue;                    		//������map����
			 }
			 return args;                                   		//�������������б����
		},
		
		/**����url��ַ�Ƿ����Ч����
		*/
		urlCheck: function( url ){
			var obj = da.ajaxSettings.xhr(),
				res = false;
			
			obj.open("HEAD", url, false);
			obj.send();
			
			if (obj.status == 200)
				res = true;
			
			obj = null;
			delete obj;
			
			return res;
		},
		
		//��ȡ�������ҳ��Ĵ������
		getRootWin: function( sPage ){
			var curWin = window;
			var parentWin = curWin.parent;
			while( curWin != parentWin ){
					if( sPage == curWin.location.href ) break;					
		
				curWin = parentWin;
				parentWin = parentWin.parent;
			}
			
			return curWin;
		},
		
		/**��sqlserver���ݿ����ڸ�ʽתΪDate��ʽ
		* params {String} sqlDate ��ֱ̨�ӷ��ص����ݿ����ڸ�ʽ�ַ���
		* params {String} sFormat ���ڸ�ʽ�������ַ���
		*/
		db2date: function( sqlDate, sFormat ){
			var t = sqlDate.replace("+08:00",""),								//ȥ��ʱ����׺
				d = t.split(/[-\.\/T:]/g);										//ͨ��split()���� �ָ��� [�꣬�£��գ�ʱ���֣��룬����] ����

			d = new Date( d[0],d[1],d[2],d[3],d[4],d[5],d[6]||0 );
			return sFormat ? d.format( sFormat ) : d;
					
		},
		
		/**�������ݼӼ�
		* params {Date|String} dateObj ��������
		* params {Int} nValue �����ֵ�����Ϊ������
		* params {String} type �������[ "y", "M", "d", "h", "m", "s", "ms" ]��Ĭ��Ϊ"d"���գ�
		*/
		addDate: function( dateObj, nValue, type ){
			type = type || "d";
			nValue = parseInt(nValue,10);
			if( !nValue ) return dateObj;
			
			if( "string" === typeof dateObj ) dateObj = new Date(dateObj);
			
			switch( type ){
				case "d":	dateObj.setDate( dateObj.getDate() + nValue );
					break;
				case "M":	dateObj.setMonth( dateObj.getMonth() + nValue );
					break;
				case "y":	dateObj.setYear( dateObj.getYear() + nValue );
					break;
				case "h":	dateObj.setHours( dateObj.getHours() + nValue );
					break;
				case "m":	dateObj.setMinutes( dateObj.getMinutes() + nValue );
					break;
				case "s":	dateObj.setSeconds( dateObj.getSeconds() + nValue );
					break;
				case "ms": dateObj.setMilliseconds( dateObj.getMilliseconds() + nValue );
					
					break;
			}
		return dateObj;
		},
		
		//������󳤶��ַ���
		/*
			str: Ŀ���ַ���
			mxlen: ��󳤶�
		*/
		limitStr: function(str,mxlen){
			return str.length > mxlen ? str.substring(0,mxlen-3)+"��":str;
		},
		
		/**��ҳ�涯̬Ƕ����ʽin-inline-css
		*/
		addStyle: function( id, cssText ){
			if( 0 <= id.indexOf("#") ){
				id = id.subStr( 1, id.length-1 );
			}
		
			var head = document.head || document.getElementsByTagName('head')[0],
				cssObj = document.getElementById(id);
				
			if( !cssObj ) {
				cssObj = document.createElement('style');
				cssObj.type='text/css';
				cssObj.id = id ;
				head.appendChild( cssObj );
			}
			
			if( cssObj.styleSheet ) {
				cssObj.styleSheet.cssText = cssObj.styleSheet.cssText + cssText;
			} 
			else {
				cssObj.appendChild(document.createTextNode(cssText));
			}
		},
		
		/**ȥhtmlԪ��
		*/
		deleteHtml: function( str ){
			return str.replace( /<("[^"]*"|'[^']*'|[^'">])*>/gi, "");
		},
		
		/**��������ֵ��ʽ��
		*/
		fmtFloat: function( val, fmt ){
			return new Number( val ).format( fmt );
		},
		
		/**���ڸ�ʽ��
		*/
		fmtDate: function( sdate, fmt ){
			if( "" === da.isNull(sdate,"")) return sdate;
		
			if( sdate instanceof Date ){
				sdate = sdate.format("yyyy-mm-dd hh:nn:ss i");
			}
		
			var tmp = sdate.replace("+08:00",""),							//ȥ��ʱ����׺(���ݿ�洢��ʽ)
				isCN, d;

			if( isCN = (0 <= fmt.indexOf("/p")) )							//�ж�����ģʽ
				fmt = fmt.replace(/\/p/g, "");

			d = sdate.split(/[-\.\/T\s:]|\+08:00/g);						//ͨ��split()���� �ָ��� [�꣬�£��գ�ʱ���֣��룬����] ����
																			//���ܳ��ֵķָ����У�"-", ".", "/", "T", " ", ":", "+08:00"
			for(var i=0,len=d.length; i<len; i++){							//�������ݸ�ʽ
				d[i] = parseInt( d[i] || 0,10 );
			}
																			
			var date = new Date( d[0], d[1]-1, d[2], d[3]||0, d[4]||0, d[5]||0, d[6]||0 );
			
			if( !isCN ) return fmt ? date.format( fmt ) : date;				//������ģʽ�����ٽ�������Ĵ���
			
			
			var now = new Date(),
				ntime = ( date.getTime()-now.getTime() )/1000,
				d2 = [
					now.getFullYear(),
					now.getMonth() + 1,
					now.getDate(),
					now.getHours(),
					now.getMinutes(),
					now.getSeconds(),
					now.getMilliseconds()
				];
				
			if( 0 > ntime ){	//��ȥʱ
				// ntime *= -1;						//����ʱ������

				if( "undefined" != typeof d[0] && d[0]!=d2[0] ){										//��ͬ��
					switch( d2[0]-d[0] ){
						case 1: return "<span style='color:#900'>ȥ��</span>" + date.format( "m��d��" );
						case 2: return "<span style='color:#900'>ǰ��</span>" + date.format( "m��d��" );
						default: return fmt ? date.format( fmt ) : date;
					}
				}
				else if( "undefined" != typeof d[1] && d[1]!=d2[1] ){									//ͬ��,��ͬ��
					switch( Math.abs(d2[1]-d[1]) ){
						case 1: 
							return "<span style='color:#900'>�ϸ���</span>" + date.format( "d��" );
						case 2: 
							return "<span style='color:#900'>������ǰ</span>" + date.format( "d��" );
						case 3: 
							return "<span style='color:#900'>������ǰ</span>" + date.format( "d��" );
						default: return date.format( "m��d��" );
					}
				}
				else if( "undefined" != typeof d[2] && d[2]!=d2[2] ){									//ͬ��,ͬ��,��ͬ��
					switch( Math.abs(d2[2]-d[2]) ){
						case 1:
							return "<span style='color:#900'>����</span>" + date.format( "hʱn��" );
						case 2:
							return "<span style='color:#900'>ǰ��</span>" + date.format( "hʱn��" );
						case 3:
							return "<span style='color:#900'>����ǰ</span>" + date.format( "hʱn��" );
						default:
							return "<span style='color:#900'>����</span>" + date.format( "d��" );
					}
				}
				else if( "undefined" != typeof d[3] && d[3]!=d2[3] ){									//ͬ��,ͬ��,ͬ��,��ͬСʱ
					switch( Math.abs(d2[3]-d[3]) ){
						case 1:
							return "<span style='color:#900'>ǰ1Сʱ</span>" + date.format( "n��" );
						case 2:
							return "<span style='color:#900'>ǰ2Сʱ</span>" + date.format( "n��" );
						case 3:
							return "<span style='color:#900'>ǰ3Сʱ</span>" + date.format( "n��" );
						default:
							return "<span style='color:#900'>����</span>" + date.format( "hʱn��" );
					}
				}
				else if( "undefined" != typeof d[4] && d[4]!=d2[4] ){									//ͬ��,ͬ��,ͬ��,ͬСʱ,��ͬ����
					return "<span style='color:#900'>"+ Math.abs(d2[4]-d[4]) +"����ǰ</span>";
				}
				else{
					return fmt ? date.format( fmt ) : date;
				}
			}
			else{				//����ʱ

				if( "undefined" != typeof d[0] && d[0]!=d2[0] ){										//��ͬ��
					switch( d2[0]-d[0] ){
						case 1: return "<span style='color:#900'>����</span>" + date.format( "m��d��" );
						case 2: return "<span style='color:#900'>����</span>" + date.format( "m��d��" );
						default: return fmt ? date.format( fmt ) : date;
					}
				}
				else if( "undefined" != typeof d[1] && d[1]!=d2[1] ){									//ͬ��,��ͬ��
					switch( Math.abs(d2[1]-d[1]) ){
						case 1: 
							return "<span style='color:#900'>�¸���</span>" + date.format( "d��" );
						case 2: 
							return "<span style='color:#900'>�����º�</span>" + date.format( "d��" );
						case 3: 
							return "<span style='color:#900'>�����º�</span>" + date.format( "d��" );
						default: return date.format( "m��d��" );
					}
				}
				else if( "undefined" != typeof d[2] && d[2]!=d2[2] ){									//ͬ��,ͬ��,��ͬ��
					switch( Math.abs(d2[2]-d[2]) ){
						case 1:
							return "<span style='color:#900'>����</span>" + date.format( "hʱn��" );
						case 2:
							return "<span style='color:#900'>����</span>" + date.format( "hʱn��" );
						case 3:
							return "<span style='color:#900'>�����</span>" + date.format( "hʱn��" );
						default:
							return "<span style='color:#900'>����</span>" + date.format( "d��" );
					}
				}
				else if( "undefined" != typeof d[3] && d[3]!=d2[3] ){									//ͬ��,ͬ��,ͬ��,��ͬСʱ
					switch( Math.abs(d2[3]-d[3]) ){
						case 1:
							return "<span style='color:#900'>1Сʱ��</span>" + date.format( "n��" );
						case 2:
							return "<span style='color:#900'>2Сʱ��</span>" + date.format( "n��" );
						case 3:
							return "<span style='color:#900'>3Сʱ��</span>" + date.format( "n��" );
						default:
							return "<span style='color:#900'>����</span>" + date.format( " hʱn��" );
					}
				}
				else if( "undefined" != typeof d[4] && d[4]!=d2[4] ){									//ͬ��,ͬ��,ͬ��,ͬСʱ,��ͬ����
					return "<span style='color:#900'>"+ Math.abs(d2[4]-d[4]) +"���Ӻ�</span>";
				}
				else{
					return fmt ? date.format( fmt ) : date;
				}
			}
					
		}
		
	});

})(da);


	//ȫ�ֱ���
	win.da = da;
	
})(window);


/***************** ���ݽ��� *****************/
/*
	author:	danny.xu
	date: 2012.5.17
	description: ���ݽ������ֹ��ܴ��룬��ҵ���ܿ�����ϵ����
	version: 1.0.0
*/

var $flds = [];			//Ϊ���ݹ�ȥ�� ebs�������÷������һЩȫ�ֱ�����
    $f = [],
	$v = [];

da.extend({
	/**��ʽ������
	*/
	fmtData: function( val, fmt ){
		if( !fmt ) return val;
		
		var val_format = val;
		
		if( "money" == fmt ){																//������
			val_format = "<span style='color:#900'>��</span>" + da.fmtFloat(val_format, "#,##");
		}
		else if( /[#\.\,]/.test(fmt) ){														//��ֵ��
			val_format = da.fmtFloat( val_format, fmt );
		}
		else{																				//������
			val_format = da.fmtDate( val_format, fmt );
		}

		return val_format;
	},
	
	/**���ؼ���ֵ
	* ��: da.setValue( "#p_name", "AH100" );
	*/
	setValue: function( obj, val ){
		var daObj = da(obj);
		
		if ( "string" === typeof obj && 0 >= daObj.dom.length ){			//��Ҫͨ��name����λ����:checkbox��radio
			var arr = obj.split(",");
			
			for( var i=0,len=arr.length; i<len; i++ ){
				arr[i] = "input[name="+ arr[i].replace("#","").trim() +"]";
			}
			daObj = da( arr.join(",") );
		};
		
		var tag, fmt, curVal;
		
		daObj.each(function(i){
			tag = this.tagName.toLowerCase();			//Ԫ������
			
			switch( tag ){
				case "input":{
					var type = this.type.toLowerCase();				//input�еĿؼ�����
					switch(type){
						case "checkbox":							//��ѡ�ؼ�
						case "radio":{								//��ѡ�ؼ�
							curVal = da.isNull(this.value, "");
							
							var tmpObj = da._data( this, "daOption" );	//�ж��Ƿ�������daOption��װ��
							if( tmpObj ){								//���������daOption������check��������
								if ( "" == curVal || "on" == curVal ) {	//����ֵ����("" == "on" == 0)
									tmpObj.check( "0" == val || true == val || "true" == val );
								}
								else {
									tmpObj.check( val == da.isNull(this.value, "") );
								};
							}
							else{
								if ( "" == curVal || "on" == curVal ) {	//����ֵ���� "" == "on" == 0
									this.setAttribute( "checked", "0" == val );
								}
								else {
									this.setAttribute( "checked", val == da.isNull(this.value, "") );
								};
							}
							
							break;
						}
						case "text":								//���������
						default:{
							fmt = da.isNull( this.getAttribute("fmt"), "" );
							
							if( "" !== fmt ){
								val = da.fmtData( val, fmt );
							}
							
							val = da.isNull( val, this.value );
							this.value = val;
							break;
						}
					}
					break;
				}
				case "textarea":{									//�ı���
					fmt = da.isNull( this.getAttribute("fmt"), "" );
					
					if( "" !== fmt ){
						val = da.fmtData( val, fmt );
					}
					
					val = da.isNull( val, this.value );
					this.value = val;
					break;
				}
				case "select":{
					if( da.isNull(val) ) return;
				
					var isFinded = false;
					for ( var i=0,len=this.options.length; i < len; i++ ) {
						if (this.options[i].value == val1) {
							this.options[i].selected = true ;
							isFinded = true;
						}
						else if( this.options[i].selected ) {
							this.options[i].selected = false ;
						}
					}
					
					if ( !isFinded ){
						if ( val != "" ){
							var obj = pobj001.document.createElement("OPTION");
							this.options.add(obj);
							obj.innerText = val;
							obj.value = val;
							obj.selected = true;
						}
					}
					break;
				}
				case "img":
					this.src = val;
					break;
			}
		});
	},
	
	/**���ݽ���
	*/
	runDB: function( url, data, fnLoaded, fnError ) {
		if( !url ) return;
		
		// if (url.toLowerCase().indexOf(".asp") < 0) {		//����url����
			// url = "/sys/aspx/execsqllist.aspx?sqlname=" + url;
		// }
		if (url.indexOf("?") < 0) {
			url += "?";
		}
		
		var isPost = da.isPlainObj(data),
			isScript = /\.js/.test(url.toLowerCase());
		
		da.ajax({
			url: url,
			type: (isPost && !isScript) ? "POST" : "GET",
			data: (isPost && !isScript) ? data : null,
			dataType: (isPost && data.dataType) ? data.dataType : "",
			async: (isPost && "undefined" != typeof data.async) ? data.async : true,
			
			error: function( xhr, status, exception ) {
				var msg = xhr.statusText,
					code = xhr.status,
					content = xhr.responseText;
					
				fnError && fnError( msg, code, content, xhr );
			},
			success: function( data, status, xhr ) {
				var dataType = xhr.getResponseHeader("content-type").match(/html|xml|json|script/).toString(),
					xml2json;

				switch( dataType ){
					case "html":
					case "json":
					case "script": {
						fnLoaded && fnLoaded( data, dataType, xhr.getResponseHeader("content-type"), xml2json );
						break;
					}
					case "xml": {
						$flds = [];													//Ϊ���ݹ�ȥ�� ebs�������÷������һЩȫ�ֱ�����
						$f = [],
						$v = [];
						
						var firstTime = true;
						xml2json = da.xml2json( data, function( type, dsname, data, idx ){
							if( "field" == type ){									//���ֶ�
								if( firstTime ){
									window["_"+ data.name] = idx;					//Ϊ���ݹ�ȥ�� ebs�������÷������һЩȫ�ֱ�����
									$flds.push( data.name );
								}
								$f.push( data.value );
							}
							if( "record" == type && data ){							//����
								if( firstTime ){
									firstTime = false;
								}
								
								$v = $f;
								fnLoaded && fnLoaded( false, data, dsname, idx);
								
								$f = [];											//���������
								$v = [];
							}
							if( "dataset" == type && da.isArray(data) ){			//�����ݼ�
								fnLoaded && fnLoaded( true, data, dsname, idx);
							}
						});
						fnLoaded && fnLoaded( true, xml2json, undefined, undefined );		//�����ص�
						
						break;
					}
					defaul:
						break;
				}
			}
		});
	},

	setForm: function( pid, url, data, fnField, fnLoaded, fnError ){
		if( "string" === typeof pid && 0 !== pid.indexOf("#") )		//����idδ��"#"
			pid = "#" + pid;
		
		var parentObj = da( pid );
		if( 0 >= parentObj.dom.length ) return;
		
		var tmpHTML = parentObj.html().replace(/[\r\t\n]/g, ""),
			fmtMap = {};
			
		var name="", fmt="", txt="", key, obj;
		da("td[fmt]", pid).each(function( idx ){
			obj = da( this );
			name = obj.attr("name");
			txt = obj.text();
			fmt = obj.attr("fmt");
			
			key = name || txt.replace(/\{|\}/g, "");
			if( key ){
				fmtMap[key] = fmt;
			}
			// if ((s1 == "sum") || (s1 == "avg") || (s1 == "min") || (s1 == "max") || (s1 == "count")) {
				// s1 = obj1.html().replace("{", "").replace("}", "") ;
			// }
			
			// if ((_isnull(s1, "") != "") && (_isnull(s2, "") != "")) {
				// _tb_fmt_flds.push(s1);
				// _tb_fmt_fmts.push(s2);
			// }
		});
	
		da.runDB( url, data, 
		function( iseof, data, dsname, idx ){
			if( "string" == typeof data ){
				data1 = iseof[0] && da.isPlainObj(iseof[0])?iseof[0]:iseof;
			}
			else{
				if(dsname) return;
				data1 = data;
			}
			
			tmpHTML = tmpHTML.replace(/\{[^\}]+\}/g, function( res, i, target ){
				fldname = res.replace( /\{|_org|_raw|\}/g, "" );
				fldvalue =  (data1[fldname] || "");
				
				var fmt = fmtMap[fldname],
					val_format = fldvalue,
					val_tohex = da.toHex(fldvalue);
				
				if( fnField ) {
					val_format = fnField( fldname, fldvalue, data1 );				//�ֶ�ֵ���û���ʽ������
				}
				
				val_format = da.fmtData( val_format, fmt );
				
				if( 0 <= res.indexOf("_org") ){									//����ԭ����
					return fldvalue;
				}
				else if( 0 <= res.indexOf("_raw") ){							//���ر�������
					return val_tohex;
				}
				else{															//���ظ�ʽ������
					return val_format;
				}
			});
			parentObj.empty();
			parentObj.html(tmpHTML);
			fnLoaded && fnLoaded( data1 );
		},
		function( msg, code, content ){
			fnError && fnError( msg, code, content );
		});
	}
	
});

/*********Ϊ���ݹ�ȥ�� ebs�������÷������һЩȫ�ֺ�����*********/
var $value = da.setValue,
	$value2 = da.setValue,
	runsql = da.runDB,
	runsql4text = da.runDB,
	runsql4xml = da.runDB;
