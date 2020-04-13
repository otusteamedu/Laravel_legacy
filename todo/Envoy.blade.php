@servers(['web' => ['192.168.10.10']])

@story('deploy')
foo
@endstory


@task('git', ['on' => 'web'])
rm test-widgets -rf
git clone git@github.com:Albinamkh21/widgets.git
@endtask

@task('foo', ['on' => 'web'])

cd ~/test-widgets
ls -la
@endtask