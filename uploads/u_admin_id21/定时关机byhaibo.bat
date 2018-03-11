set/p str=
if %str% == 0 ( shutdown -a 
) else ( shutdown -s -f -t %str% )
pause