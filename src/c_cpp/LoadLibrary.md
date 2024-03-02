## LoadLibrary加载dll示例

	#include <iostream>
	#include <windows.h>
	
	//typedef const char* (WINAPI* MY_FUNC)(void);
	typedef std::string (WINAPI* MY_FUNC)(void);
	MY_FUNC func;
	
	int main()
	{
	   // const char* dllName = ;
	    //HMODULE g_hDll = LoadLibrary(L"skyline_geos.dll");//加载dll，将dll放在该工程根路径即可
		HMODULE g_hDll = LoadLibrary(L"geos2.dll");//加载dll，将dll放在该工程根路径即可
		//HMODULE g_hDll = LoadLibrary(L"osg_geos.dll");//加载dll，将dll放在该工程根路径即可
		std::cout << "Hello World!\n" << g_hDll << std::endl;
	
		if (!g_hDll) {
			std::cout << "could not load the dynamic library:GetLastError" << GetLastError()<< std::endl;
			return EXIT_FAILURE;
		}
	
		// resolve function address here
		/*f_funci funci = (f_funci)GetProcAddress(hGetProcIDDLL, "funci");
		if (!funci) {
			std::cout << "could not locate the function" << std::endl;
			return EXIT_FAILURE;
		}*/
	
		if (g_hDll) {
			std::cout << "Hello g_hDll!\n";
			//func = (MY_FUNC)GetProcAddress(g_hDll, "GEOSversion");
			func = (MY_FUNC)GetProcAddress(g_hDll, "geos::geom::geosversion");
			//func = (MY_FUNC)GetProcAddress(g_hDll, "geosversion");
			if (func == NULL) {
				std::cout << "Failed to get function address.GetLastError:" << GetLastError()  << std::endl;
				return 1;
			}
			else {
				std::cout << func();
			}
		}
		
	}
